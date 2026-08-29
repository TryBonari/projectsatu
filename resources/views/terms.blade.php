<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat &amp; Ketentuan — NexaTopUp</title>
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

    <p class="form-title">Syarat &amp; Ketentuan</p>
    <p class="updated">Terakhir diperbarui: 1 Januari 2025</p>

    <h2>1. Penerimaan Syarat</h2>
    <p>Dengan mendaftar dan menggunakan layanan NexaTopUp, Anda menyatakan telah membaca, memahami, dan menyetujui syarat dan ketentuan ini.</p>

    <h2>2. Layanan</h2>
    <p>NexaTopUp menyediakan layanan top-up saldo dan item dalam game secara digital. Kami berhak mengubah, menghentikan, atau membatasi layanan sewaktu-waktu tanpa pemberitahuan sebelumnya.</p>

    <h2>3. Akun Pengguna</h2>
    <ul>
        <li>Anda bertanggung jawab menjaga kerahasiaan data akun (email dan password).</li>
        <li>Satu orang hanya diperbolehkan memiliki satu akun aktif.</li>
        <li>Kami berhak menangguhkan akun yang melanggar ketentuan ini.</li>
    </ul>

    <h2>4. Transaksi</h2>
    <ul>
        <li>Seluruh transaksi bersifat final dan tidak dapat dibatalkan setelah diproses.</li>
        <li>Pastikan data ID game yang Anda masukkan sudah benar sebelum melakukan pembelian.</li>
        <li>NexaTopUp tidak bertanggung jawab atas kesalahan akibat data yang salah dimasukkan pengguna.</li>
    </ul>

    <h2>5. Larangan Penggunaan</h2>
    <ul>
        <li>Dilarang menggunakan layanan untuk kegiatan penipuan atau ilegal.</li>
        <li>Dilarang melakukan manipulasi sistem atau percobaan akses tidak sah.</li>
    </ul>

    <h2>6. Perubahan Syarat</h2>
    <p>NexaTopUp dapat memperbarui syarat dan ketentuan ini kapan saja. Penggunaan layanan secara berkelanjutan setelah perubahan dianggap sebagai persetujuan atas ketentuan terbaru.</p>

    <a href="{{ route('register') }}" class="back-link">← Kembali ke halaman daftar</a>
</div>

</body>
</html>
