@include('topup._layout', [
    'gameImage'         => 'images/games/pubg.png',
    'gameDesc'          => 'Top-up UC (Unknown Cash) langsung ke akun kamu',
    'gameIdLabel'       => 'ID Akun PUBG Mobile',
    'gameIdPlaceholder' => 'Contoh: 5123456789',
    'gameIdHint'        => 'Buka game → Settings → About → Character ID.',
    'processRoute'      => 'topup.pubg.process',
    'needsZoneId'       => false,
])
