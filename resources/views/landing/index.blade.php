@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    @include('landing.sections.navbar')

    @include('landing.sections.hero')

    @include('landing.sections.features')

    @include('landing.sections.gallery')

@endsection