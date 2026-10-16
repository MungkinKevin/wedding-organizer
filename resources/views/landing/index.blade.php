@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    @include('landing.sections.navbar')

   @include('landing.sections.hero')

   @include('landing.sections.features')

   @include('landing.sections.packages')

   @include('landing.sections.gallery')

    @include('landing.sections.testimonials')

   @include('landing.sections.about')

   @include('landing.sections.faq')

   @include('landing.sections.footer')

@endsection