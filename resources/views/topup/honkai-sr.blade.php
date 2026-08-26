@include('topup._layout', [
    'gameImage'         => 'images/games/honkai-sr.png',
    'gameDesc'          => 'Top-up Oneiric Shard & Express Pass langsung ke akun kamu',
    'gameIdLabel'       => 'UID Honkai: Star Rail',
    'gameIdPlaceholder' => 'Contoh: 600000000',
    'gameIdHint'        => 'Buka game → Profil → UID di pojok kiri bawah layar.',
    'processRoute'      => 'topup.honkai.process',
    'needsZoneId'       => false,
])
