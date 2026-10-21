@extends('layouts.app-user')

@section('title', 'Profil Saya - WO Satria')

@section('content')
    <div class="container-fluid px-2">
        <!-- Judul Halaman -->
        <h3 class="fw-bold mb-4 text-dark" style="font-family: serif;">Akun</h3>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="row align-items-center">
                
                <!-- Kolom Kiri: Foto Profil & Tombol Aksi -->
                <div class="col-md-4 text-center border-end pe-md-4 mb-4 mb-md-0">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" 
                             style="width: 130px; height: 130px; background-color: #0d6efd; font-size: 50px; font-weight: bold;">
                            Z
                        </div>
                    </div>

                    <div class="d-grid gap-2 col-10 mx-auto">
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;">GANTI FOTO</button>
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;">EDIT PROFIL</button>
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;">EDIT INFORMASI PERNIKAHAN</button>
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;">UBAH KATA SANDI</button>
                    </div>
                </div>

                <!-- Kolom Kanan: Rincian Akun & Kontak -->
                <div class="col-md-8 ps-md-4">
                    <!-- Pengaturan Akun -->
                    <h5 class="fw-bold text-dark mb-3">Pengaturan Akun</h5>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Nama</div>
                        <div class="col-8 fw-semibold text-dark">Zharif Widi</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Jenis kelamin</div>
                        <div class="col-8 fw-semibold text-dark">Wanita</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-4 text-muted">Hari ulang tahun</div>
                        <div class="col-8 text-muted fst-italic" style="font-size: 14px;">Belum diatur</div>
                    </div>
        
                    <hr class="text-muted opacity-25 my-4">

                    <!-- Informasi Kontak -->
                    <h5 class="fw-bold text-dark mb-3">Informasi Kontak</h5>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Nomor WhatsApp</div>
                        <div class="col-8 text-muted fst-italic" style="font-size: 14px;">Belum diatur</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">E-mail</div>
                        <div class="col-8 fw-semibold text-dark d-flex align-items-center gap-2">
                            akunrplzharif@gmail.com 
                            <i class="bi bi-check-circle-fill text-success" title="Terverifikasi"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection