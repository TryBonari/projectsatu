@include('topup._layout', [
    'gameImage'         => 'images/games/mobile-legends.png',
    'gameName'          => 'Mobile Legends: Bang Bang',
    'gameDesc'          => 'Top-up Diamond & Pass langsung ke akun kamu',
    'gameIdLabel'       => 'User ID',
    'gameIdPlaceholder' => 'Contoh: 123456789',
    'gameIdHint'        => 'Temukan User ID di pojok kiri atas profil in-game.',
    'processRoute'      => 'topup.ml.process',
    'needsZoneId'       => true,
])
