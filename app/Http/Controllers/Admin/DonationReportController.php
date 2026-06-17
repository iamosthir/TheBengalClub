<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCategory;
use App\Models\Expense;
use Illuminate\Http\Request;

class DonationReportController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear  = $request->input('year');
        $selectedMonth = $request->input('month');

        // Build a date scope closure reusable for both donations and expenses
        $dateScope = function ($query) use ($selectedYear, $selectedMonth) {
            if ($selectedYear) {
                $query->whereYear('created_at', $selectedYear);
            }
            if ($selectedMonth) {
                $query->whereMonth('created_at', $selectedMonth);
            }
        };

        $categories = DonationCategory::withCount([
            'donations as verified_count' => function ($q) use ($dateScope) {
                $q->where('status', 'verified');
                $dateScope($q);
            },
        ])
        ->withSum(['donations as verified_total' => function ($q) use ($dateScope) {
            $q->where('status', 'verified');
            $dateScope($q);
        }], 'amount')
        ->withSum(['expenses as expense_total' => function ($q) use ($dateScope) {
            $dateScope($q);
        }], 'amount')
        ->orderBy('name')
        ->get()
        ->map(function ($cat) {
            $cat->verified_total = (float) ($cat->verified_total ?? 0);
            $cat->expense_total  = (float) ($cat->expense_total  ?? 0);
            $cat->net_balance    = $cat->verified_total - $cat->expense_total;
            return $cat;
        });

        // Uncategorized
        $uncategorizedDonations = Donation::whereNull('donation_category_id')
            ->where('status', 'verified')
            ->when($selectedYear,  fn ($q) => $q->whereYear('created_at', $selectedYear))
            ->when($selectedMonth, fn ($q) => $q->whereMonth('created_at', $selectedMonth))
            ->sum('amount');

        $uncategorizedExpenses = Expense::whereNull('donation_category_id')
            ->when($selectedYear,  fn ($q) => $q->whereYear('created_at', $selectedYear))
            ->when($selectedMonth, fn ($q) => $q->whereMonth('created_at', $selectedMonth))
            ->sum('amount');

        $grandTotal    = $categories->sum('verified_total') + $uncategorizedDonations;
        $grandExpenses = $categories->sum('expense_total')  + $uncategorizedExpenses;
        $grandBalance  = $grandTotal - $grandExpenses;

        // Build year list from earliest donation/expense record
        $earliestDonation = Donation::min('created_at');
        $earliestExpense  = Expense::min('created_at');
        $earliestYear     = min(
            $earliestDonation ? date('Y', strtotime($earliestDonation)) : date('Y'),
            $earliestExpense  ? date('Y', strtotime($earliestExpense))  : date('Y')
        );
        $years = range((int) $earliestYear, (int) date('Y'));

        $months = [
            1  => 'January',  2  => 'February', 3  => 'March',
            4  => 'April',    5  => 'May',       6  => 'June',
            7  => 'July',     8  => 'August',    9  => 'September',
            10 => 'October',  11 => 'November',  12 => 'December',
        ];

        return view('admin.pages.donation-report.index', compact(
            'categories',
            'uncategorizedDonations',
            'uncategorizedExpenses',
            'grandTotal',
            'grandExpenses',
            'grandBalance',
            'years',
            'months',
            'selectedYear',
            'selectedMonth'
        ));
    }
}
