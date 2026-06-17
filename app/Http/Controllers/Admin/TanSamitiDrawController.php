<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TanSamiti;
use App\Models\TanSamitiDraw;
use Illuminate\Http\Request;

class TanSamitiDrawController extends Controller
{
    public function show(TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->lotteryEnabled()) {
            return redirect()->route('admin.tan-samiti.show', $tanSamiti)
                ->with('error', 'Lottery draw is disabled for this Investment Plan.');
        }

        $eligible = $tanSamiti->eligibleForDraw();
        $draws    = $tanSamiti->draws()->with('user.profile', 'drawnBy')->orderBy('cycle_number')->get();

        return view('admin.pages.tan-samiti.draw', compact('tanSamiti', 'eligible', 'draws'));
    }

    /**
     * Pick a random eligible winner — does NOT save yet.
     * Returns JSON so the spinner JS can animate to the chosen winner.
     */
    public function spin(TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->lotteryEnabled()) {
            return response()->json(['error' => 'Lottery draw is disabled for this Investment Plan.'], 422);
        }

        $eligible = $tanSamiti->eligibleForDraw();

        if ($eligible->isEmpty()) {
            return response()->json(['error' => 'No eligible members left to draw.'], 422);
        }

        $winner = $eligible->random();

        return response()->json([
            'winner_user_id' => $winner->user_id,
            'winner_name'    => $winner->user->name,
            'winner_photo'   => $winner->user->profile?->photo
                ? asset('storage/' . $winner->user->profile->photo)
                : null,
            'cycle_number'   => $tanSamiti->nextCycleNumber(),
        ]);
    }

    /**
     * Confirm and persist the draw result.
     */
    public function confirm(Request $request, TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->lotteryEnabled()) {
            return back()->with('error', 'Lottery draw is disabled for this Investment Plan.');
        }

        $request->validate([
            'user_id'      => 'required|exists:users,id',
            'cycle_number' => 'required|integer|min:1',
            'note'         => 'nullable|string|max:1000',
        ]);

        // Guard: member must be eligible (active + not yet won)
        $alreadyWon = $tanSamiti->draws()
            ->where('user_id', $request->user_id)
            ->exists();

        $isMember = $tanSamiti->activeMembers()
            ->where('user_id', $request->user_id)
            ->exists();

        if ($alreadyWon || ! $isMember) {
            return back()->with('error', 'Invalid winner. Member either already won or is not active.');
        }

        // Guard: cycle must not already have a winner
        $cycleUsed = $tanSamiti->draws()
            ->where('cycle_number', $request->cycle_number)
            ->exists();

        if ($cycleUsed) {
            return back()->with('error', "Cycle #{$request->cycle_number} already has a winner.");
        }

        TanSamitiDraw::create([
            'tan_samiti_id'    => $tanSamiti->id,
            'user_id'          => $request->user_id,
            'cycle_number'     => $request->cycle_number,
            'drawn_at'         => now(),
            'drawn_by_admin_id' => auth('admin')->id(),
            'note'             => $request->note,
        ]);

        return redirect()->route('admin.tan-samiti.draw.show', $tanSamiti)
            ->with('success', "Draw #{$request->cycle_number} confirmed! Winner recorded.");
    }
}
