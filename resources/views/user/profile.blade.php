@extends('layouts.app-user')

@section('title', 'Profil Saya - WO Satria')

@section('content')
    <div class="container-fluid px-2">
        <h3 class="fw-bold mb-4 text-dark" style="font-family: serif;">Akun</h3>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="row align-items-center">
                
                <!-- Kolom Kiri -->
                <div class="col-md-4 text-center border-end pe-md-4 mb-4 mb-md-0">
                    <div class="d-flex justify-content-center mb-3">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto Profil" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background-color: #c46893; font-size: 50px; font-weight: bold;">
                                {{ substr(Auth::user()->name ?? 'Z', 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <div class="d-grid gap-2 col-10 mx-auto">
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#gantiFotoModal">
                            GANTI FOTO 
                        </button>
   
                        
                        
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                            EDIT PROFIL
                        </button>
                        <button class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#ubahSandiModal">
                            UBAH KATA SANDI
                        </button>
                        
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-8 ps-md-4">
                    <!-- Pengaturan AKN-->
                    <h5 class="fw-bold text-dark mb-3">Pengaturan Akun</h5>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Nama</div>
                        <div class="col-8 fw-semibold text-dark">{{ Auth::user()->name ?? 'Zharif Widi' }}</div>
                    </div>
    
                    <hr class="text-muted opacity-25 my-4">

                    <!-- Informasi Kontak -->
                    <h5 class="fw-bold text-dark mb-3">Informasi Kontak</h5>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">Nomor WhatsApp</div>
                        <div class="col-8 {{ Auth::user()->phone ? 'fw-semibold text-dark' : 'text-muted fst-italic' }}" style="font-size: 14px;">
                            {{ Auth::user()->phone ?? 'Belum diatur' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted">E-mail</div>
                        <div class="col-8 fw-semibold text-dark d-flex align-items-center gap-2">
                            {{ Auth::user()->email ?? 'akunrplzharif@gmail.com' }} 
                            <i class="bi bi-check-circle-fill text-success" title="Terverifikasi"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

   
    <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" id="editProfilModalLabel">Edit Informasi Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Nomor WhatsApp</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="Masukkan nomor WA">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white rounded-pill px-4" style="background-color: #e83e8c;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Buat ganti foto -->
<div class="modal fade" id="gantiFotoModal" tabindex="-1" aria-labelledby="gantiFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="gantiFotoModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.profile.photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <label for="avatar" class="form-label text-muted small">Pilih foto baru (JPG, PNG, max 2MB)</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-4" style="background-color: #e83e8c;">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Buat ubah sandi -->
<div class="modal fade" id="ubahSandiModal" tabindex="-1" aria-labelledby="ubahSandiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="ubahSandiModalLabel">Ubah Kata Sandi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/user/password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">Kata Sandi Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password lama" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-4" style="background-color: #e83e8c;">Simpan Sandi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection