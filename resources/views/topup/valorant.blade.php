@include('topup._layout', [
    'gameImage'         => 'images/games/valorant.png',
    'gameDesc'          => 'Top-up Valorant Points (VP) langsung ke akun kamu',
    'gameIdLabel'       => 'Riot ID',
    'gameIdPlaceholder' => 'Contoh: NamaKamu#1234',
    'gameIdHint'        => 'Format: Nama#Tagline. Cek di profil Riot Games kamu.',
    'processRoute'      => 'topup.valorant.process',
    'needsZoneId'       => false,
])
