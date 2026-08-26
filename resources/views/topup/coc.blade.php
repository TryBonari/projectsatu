@include('topup._layout', [
    'gameImage'         => 'images/games/coc.png',
    'gameDesc'          => 'Top-up Gems langsung ke akun kamu',
    'gameIdLabel'       => 'Player Tag Clash of Clans',
    'gameIdPlaceholder' => 'Contoh: #ABC123XY',
    'gameIdHint'        => 'Buka game → Profil → salin Player Tag (dimulai dengan #).',
    'processRoute'      => 'topup.coc.process',
    'needsZoneId'       => false,
])
