<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $categoryId;
    protected $search;

    public function __construct($categoryId = null, $search = null)
    {
        $this->categoryId = $categoryId;
        $this->search = $search;
    }

    public function collection()
    {
        $query = User::with(['profile.membershipCategory']);

        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('profile', function ($profileQuery) use ($search) {
                        $profileQuery->where('mobile', 'like', "%{$search}%")
                            ->orWhere('nid_passport', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($this->categoryId)) {
            $query->whereHas('profile', function ($profileQuery) {
                $profileQuery->where('membership_category_id', $this->categoryId);
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'NID/Passport',
            'Date of Birth',
            'Profession/Organization',
            'Address',
            'Membership Category',
            'Membership Start',
            'Membership End',
            'Status',
            'Registration Date',
        ];
    }

    public function map($user): array
    {
        $profile = $user->profile;

        return [
            $user->id,
            $user->name,
            $user->email,
            $profile->mobile ?? 'N/A',
            $profile->nid_passport ?? 'N/A',
            $profile && $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : 'N/A',
            $profile->profession_organization ?? 'N/A',
            $profile->address ?? 'N/A',
            $profile && $profile->membershipCategory ? $profile->membershipCategory->title : 'N/A',
            $profile && $profile->membership_start_at ? $profile->membership_start_at->format('Y-m-d') : 'N/A',
            $profile && $profile->membership_end_at ? $profile->membership_end_at->format('Y-m-d') : 'N/A',
            $user->isSuspended() ? 'Suspended' : 'Active',
            $user->created_at->format('Y-m-d H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
