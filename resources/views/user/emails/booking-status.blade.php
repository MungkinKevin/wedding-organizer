<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .card { background: #ffffff; padding: 20px; border-radius: 8px; max-width: 500px; margin: 0 auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        
        /* Badge Warna Sesuai Admin (Subtle style disesuaikan untuk email) */
        .badge-pending { color: #997404; background-color: #fff3cd; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        .badge-diproses { color: #084298; background-color: #cfe2ff; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        .badge-dikonfirmasi { color: #0f5132; background-color: #d1e7dd; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        .badge-selesai { color: #055160; background-color: #cff4fc; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        .badge-dibatalkan { color: #41464b; background-color: #e2e3e5; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        
        .btn { display: inline-block; padding: 10px 15px; color: #ffffff; background-color: #e83e8c; text-decoration: none; border-radius: 5px; margin-top: 15px; }
    </style>
</head>

<body>
    <div class="card">
        <h2>Halo, {{ $booking->user->name ?? 'Pelanggan' }}!</h2>
        <p>Ada pembaruan status untuk pengajuan booking acara pernikahan Anda.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee;">
        <p><strong>ID Booking:</strong> BKNG-{{ $booking->id }}</p>
        <p><strong>Status Terbaru:</strong> 
            @php $status = strtolower($booking->status); @endphp

            @if($status == 'pending')
                <span class="badge-pending">PENDING</span>
            @elseif($status == 'diproses')
                <span class="badge-diproses">DIPROSES</span>
            @elseif($status == 'dikonfirmasi')
                <span class="badge-dikonfirmasi">DIKONFIRMASI</span>
            @elseif($status == 'selesai')
                <span class="badge-selesai">SELESAI</span>
            @elseif($status == 'dibatalkan')
                <span class="badge-dibatalkan">DIBATALKAN</span>
            @else
                <span>{{ strtoupper($booking->status) }}</span>
            @endif
        </p>
        <hr style="border: 0; border-top: 1px solid #eee;">

        <p>Silakan login ke dashboard Anda untuk melihat rincian lebih detail.</p>
        <a href="{{ route('login') }}" class="btn">Buka Dashboard Saya</a>
        
        <br><br>
        <small style="color: #777;">Terima kasih telah mempercayai layanan Wedding Organizer kami.</small>
    </div>
</body>
</html>