@extends('layouts.app-user')

@section('title', 'Beranda - WO Satria')

@section('content')
    <div class="card border-0 text-white mb-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #981172, #1e293b);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, Pengantin Bahagia! 👋</h4>
                <p class="mb-0 text-white-50 small">Kelola rencana pernikahan impian Anda bersama WO SATRIA di sini.</p>
            </div>
            <a href="#" class="btn btn-light font-semibold text-danger border-0 px-4 rounded-3 shadow-sm" style="color: #e83e8c !important;">
                <i class="bi bi-search me-1"></i> Cari Paket
            </a>
        </div>
    </div>
@endsection