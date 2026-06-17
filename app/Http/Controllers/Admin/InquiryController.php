<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries
     */
    public function index()
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Inquiry::unread()->count();

        return view('admin.pages.inquiries.index', compact('inquiries', 'unreadCount'));
    }

    /**
     * Display the specified inquiry
     */
    public function show(Inquiry $inquiry)
    {
        // Mark as viewed when admin opens it
        if (!$inquiry->is_viewed) {
            $inquiry->markAsViewed();
        }

        return view('admin.pages.inquiries.show', compact('inquiry'));
    }

    /**
     * Remove the specified inquiry from storage
     */
    public function destroy(Inquiry $inquiry)
    {
        try {
            $inquiry->delete();

            return redirect()
                ->route('admin.inquiries.index')
                ->with('success', 'Inquiry deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.inquiries.index')
                ->with('error', 'Failed to delete inquiry: ' . $e->getMessage());
        }
    }

    /**
     * Mark inquiry as viewed
     */
    public function markAsViewed(Inquiry $inquiry)
    {
        $inquiry->markAsViewed();

        return response()->json([
            'success' => true,
            'message' => 'Inquiry marked as viewed.'
        ]);
    }

    /**
     * Mark inquiry as unread
     */
    public function markAsUnread(Inquiry $inquiry)
    {
        $inquiry->update(['is_viewed' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Inquiry marked as unread.'
        ]);
    }

    /**
     * Get unread count (for AJAX updates)
     */
    public function getUnreadCount()
    {
        $count = Inquiry::unread()->count();

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Delete multiple inquiries
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:inquiries,id'
        ]);

        try {
            Inquiry::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' inquiries deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete inquiries: ' . $e->getMessage()
            ], 500);
        }
    }
}
