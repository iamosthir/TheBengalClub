<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TanSamiti extends Model
{
    protected $fillable = [
        'name',
        'description',
        'monthly_amount',
        'total_cycles',
        'enable_lottery_draw',
        'member_limit',
        'start_date',
        'status',
        'created_by_admin_id',
    ];

    protected $casts = [
        'monthly_amount'      => 'decimal:2',
        'total_cycles'        => 'integer',
        'enable_lottery_draw' => 'boolean',
        'member_limit'        => 'integer',
        'start_date'          => 'date',
    ];

    public function members()
    {
        return $this->hasMany(TanSamitiMember::class);
    }

    public function activeMembers()
    {
        return $this->hasMany(TanSamitiMember::class)->where('status', 'active');
    }

    public function installments()
    {
        return $this->hasMany(TanSamitiInstallment::class);
    }

    public function draws()
    {
        return $this->hasMany(TanSamitiDraw::class)->orderBy('cycle_number');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function lotteryEnabled(): bool
    {
        return (bool) $this->enable_lottery_draw;
    }

    public function hasMemberLimit(): bool
    {
        return ! is_null($this->member_limit) && $this->member_limit > 0;
    }

    public function isFull(): bool
    {
        if (! $this->hasMemberLimit()) {
            return false;
        }

        return $this->activeMembers()->count() >= $this->member_limit;
    }

    public function availableSlots(): ?int
    {
        if (! $this->hasMemberLimit()) {
            return null;
        }

        return max(0, $this->member_limit - $this->activeMembers()->count());
    }

    public function nextCycleNumber(): int
    {
        return ($this->draws()->max('cycle_number') ?? 0) + 1;
    }

    public function eligibleForDraw()
    {
        $wonUserIds = $this->draws()->pluck('user_id');

        return $this->activeMembers()
            ->whereNotIn('user_id', $wonUserIds)
            ->with('user.profile')
            ->get();
    }

    /**
     * Generate installments for a single user for every cycle in this plan.
     * Skips any cycles the user already has an installment for.
     */
    public function generateInstallmentsForUser(int $userId): int
    {
        $baseDate = $this->start_date
            ? Carbon::parse($this->start_date)
            : Carbon::now()->addMonth()->startOfMonth();

        $existingCycles = $this->installments()
            ->where('user_id', $userId)
            ->pluck('cycle_number')
            ->toArray();

        $created = 0;

        for ($cycle = 1; $cycle <= $this->total_cycles; $cycle++) {
            if (in_array($cycle, $existingCycles, true)) {
                continue;
            }

            TanSamitiInstallment::create([
                'tan_samiti_id' => $this->id,
                'user_id'       => $userId,
                'cycle_number'  => $cycle,
                'due_date'      => $baseDate->copy()->addMonths($cycle - 1)->toDateString(),
                'amount'        => $this->monthly_amount,
                'status'        => 'pending',
            ]);

            $created++;
        }

        return $created;
    }

    /**
     * Regenerate missing installments for every active member.
     * Useful after total_cycles or start_date changes.
     */
    public function regenerateInstallmentsForAllActiveMembers(): int
    {
        $total = 0;

        foreach ($this->activeMembers()->pluck('user_id') as $userId) {
            $total += $this->generateInstallmentsForUser($userId);
        }

        return $total;
    }
}
