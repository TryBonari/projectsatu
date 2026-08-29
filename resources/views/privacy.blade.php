<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .legal-card { max-width: 680px; }
        .legal-card h2 { font-size: 18px; font-weight: 700; color: #ffffff; margin: 28px 0 10px; }
        .legal-card h2:first-of-type { margin-top: 0; }
        .legal-card p, .legal-card li { font-size: 13.5px; color: rgba(255,255,255,0.55); line-height: 1.75; }
        .legal-card ul { padding-left: 20px; margin: 0; }
        .legal-card ul li { margin-bottom: 6px; }
        .legal-card .back-link { display: inline-block; margin-top: 28px; font-size: 13px; color: #6339ff; text-decoration: none; font-weight: 500; }
        .legal-card .back-link:hover { color: #00c2ff; }
        .legal-card .updated { font-size: 11.5px; color: rgba(255,255,255,0.25); margin-bottom: 24px; }
    </style>
</head>
<body class="auth-page register-page">

<div class="card card--wide legal-card">
    <div class="brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
        </div>
        <h1>NexaTopUp</h1>
    </div>

    <p class="form-title">Kebijakan Privasi</p>
    <p class="updated">Terakhir diperbarui: 1 Januari 2025</p>

    <h2>1. Data yang Kami Kumpulkan</h2>
    <ul>
        <li><strong style="color:#fff">Data Akun:</strong> nama, alamat email, dan nomor telepon yang Anda daftarkan.</li>
        <li><strong style="color:#fff">Data Transaksi:</strong> riwayat top-up, ID game, dan jumlah pembelian.</li>
        <li><strong style="color:#fff">Data Teknis:</strong> alamat IP dan jenis perangkat untuk keamanan layanan.</li>
    </ul>

    <h2>2. Penggunaan Data</h2>
    <ul>
        <li>Memproses transaksi dan mengirimkan konfirmasi.</li>
        <li>Mengirimkan notifikasi terkait akun dan layanan.</li>
        <li>Meningkatkan keamanan dan kualitas layanan.</li>
        <li>Memenuhi kewajiban hukum yang berlaku.</li>
    </ul>

    <h2>3. Penyimpanan &amp; Keamanan</h2>
    <p>Data Anda disimpan di server yang aman dengan enkripsi. Kami tidak menjual atau membagikan data pribadi Anda kepada pihak ketiga tanpa persetujuan, kecuali diwajibkan oleh hukum.</p>

    <h2>4. Hak Pengguna</h2>
    <ul>
        <li>Anda dapat meminta akses, koreksi, atau penghapusan data akun kapan saja.</li>
        <li>Hubungi kami melalui email support untuk mengajukan permintaan tersebut.</li>
    </ul>

    <h2>5. Cookie</h2>
    <p>Kami menggunakan cookie sesi untuk menjaga status login Anda. Cookie ini tidak digunakan untuk pelacakan iklan.</p>

    <h2>6. Perubahan Kebijakan</h2>
    <p>Kebijakan privasi ini dapat diperbarui sewaktu-waktu. Perubahan material akan diberitahukan melalui email atau notifikasi di dalam aplikasi.</p>

    <a href="{{ route('register') }}" class="back-link">← Kembali ke halaman daftar</a>
</div>

</body>
</html>
