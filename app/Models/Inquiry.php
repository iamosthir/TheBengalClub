<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_viewed',
        'ip_address',
    ];

    protected $casts = [
        'is_viewed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to get unread inquiries
     */
    public function scopeUnread($query)
    {
        return $query->where('is_viewed', false);
    }

    /**
     * Scope to get read inquiries
     */
    public function scopeRead($query)
    {
        return $query->where('is_viewed', true);
    }

    /**
     * Mark inquiry as viewed
     */
    public function markAsViewed()
    {
        $this->update(['is_viewed' => true]);
    }

    /**
     * Check if inquiry can be sent from this IP
     * (Maximum 2 inquiries per 24 hours, with 12-hour gap)
     */
    public static function canSendInquiry(string $ipAddress): bool
    {
        $twentyFourHoursAgo = now()->subHours(24);

        // Get all inquiries from this IP in the last 24 hours
        $recentInquiries = self::where('ip_address', $ipAddress)
            ->where('created_at', '>=', $twentyFourHoursAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        // If no inquiries, allow
        if ($recentInquiries->isEmpty()) {
            return true;
        }

        // If 2 or more inquiries in last 24 hours, deny
        if ($recentInquiries->count() >= 2) {
            return false;
        }

        // If 1 inquiry, check if 12 hours have passed
        $lastInquiry = $recentInquiries->first();
        $twelveHoursAgo = now()->subHours(12);

        return $lastInquiry->created_at <= $twelveHoursAgo;
    }

    /**
     * Get time remaining until next inquiry can be sent
     */
    public static function getNextAvailableTime(string $ipAddress): ?string
    {
        $twentyFourHoursAgo = now()->subHours(24);

        $recentInquiries = self::where('ip_address', $ipAddress)
            ->where('created_at', '>=', $twentyFourHoursAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($recentInquiries->isEmpty()) {
            return null;
        }

        if ($recentInquiries->count() >= 2) {
            // Return when the oldest inquiry will be 24 hours old
            $oldestInquiry = $recentInquiries->last();
            return $oldestInquiry->created_at->addHours(24)->diffForHumans();
        }

        // Return when 12 hours will pass since last inquiry
        $lastInquiry = $recentInquiries->first();
        return $lastInquiry->created_at->addHours(12)->diffForHumans();
    }
}
