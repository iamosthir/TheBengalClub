@extends('frontend.layouts.master')

@section("content")
    {{-- Hero Banner --}}
    @include("frontend.components.home.banner")

    {{-- Introduction/About --}}
    @include("frontend.components.home.about")

    {{-- Facilities --}}
    @include("frontend.components.home.facilities")

    {{-- Membership Categories --}}
    @include("frontend.components.home.membership-categories")

    {{-- Membership Benefits & Eligibility --}}
    @include("frontend.components.home.membership-benefits")

    {{-- Fees and Renewal Policy --}}
    @include("frontend.components.home.fees-renewal")

    {{-- Vision & Mission --}}
    @include("frontend.components.home.vision-mission")

    {{-- Board of Directors --}}
    @include("frontend.components.home.directors")

    {{-- Events --}}
    @include("frontend.components.home.events")

    {{-- Archive --}}
    @include("frontend.components.home.archive")

    {{-- Social Responsibility --}}
    @include("frontend.components.home.social-responsibility")

    {{-- Contact --}}
    @include("frontend.components.home.contact")
@endsection
