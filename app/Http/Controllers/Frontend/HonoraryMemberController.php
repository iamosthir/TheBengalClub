<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HonoraryMember;

class HonoraryMemberController extends Controller
{
    public function index()
    {
        $members = HonoraryMember::active()->orderBy('order')->orderBy('id')->get();
        return view('frontend.pages.honorary-members', compact('members'));
    }
}
