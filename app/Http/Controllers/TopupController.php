<?php

namespace App\Http\Controllers;

use App\Models\SaldoHistory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopupController extends Controller
{
    // ── Package lists ────────────────────────────────────────────────────────

    private array $mlPackages = [
        ['id' => 1,  'label' => '5 Diamond',     'amount' => 1500],
        ['id' => 2,  'label' => '12 Diamond',    'amount' => 3000],
        ['id' => 3,  'label' => '19 Diamond',    'amount' => 5000],
        ['id' => 4,  'label' => '28 Diamond',    'amount' => 7000],
        ['id' => 5,  'label' => '50 Diamond',    'amount' => 13000],
        ['id' => 6,  'label' => '86 Diamond',    'amount' => 22000],
        ['id' => 7,  'label' => '172 Diamond',   'amount' => 43000],
        ['id' => 8,  'label' => '257 Diamond',   'amount' => 65000],
        ['id' => 9,  'label' => '344 Diamond',   'amount' => 86000],
        ['id' => 10, 'label' => '514 Diamond',   'amount' => 128000],
        ['id' => 11, 'label' => '706 Diamond',   'amount' => 175000],
        ['id' => 12, 'label' => 'Weekly Pass',   'amount' => 29000],
        ['id' => 13, 'label' => 'Twilight Pass', 'amount' => 145000],
    ];

    private array $ffPackages = [
        ['id' => 1,  'label' => '5 Diamond',    'amount' => 1500],
        ['id' => 2,  'label' => '12 Diamond',   'amount' => 3500],
        ['id' => 3,  'label' => '50 Diamond',   'amount' => 12500],
        ['id' => 4,  'label' => '70 Diamond',   'amount' => 17500],
        ['id' => 5,  'label' => '140 Diamond',  'amount' => 35000],
        ['id' => 6,  'label' => '355 Diamond',  'amount' => 88000],
        ['id' => 7,  'label' => '500 Diamond',  'amount' => 124000],
        ['id' => 8,  'label' => '720 Diamond',  'amount' => 179000],
        ['id' => 9,  'label' => '1450 Diamond', 'amount' => 360000],
        ['id' => 10, 'label' => '2180 Diamond', 'amount' => 540000],
        ['id' => 11, 'label' => 'Weekly Pass',  'amount' => 19000],
    ];

    private array $pubgPackages = [
        ['id' => 1,  'label' => '60 UC',    'amount' => 15000],
        ['id' => 2,  'label' => '120 UC',   'amount' => 30000],
        ['id' => 3,  'label' => '325 UC',   'amount' => 79000],
        ['id' => 4,  'label' => '660 UC',   'amount' => 159000],
        ['id' => 5,  'label' => '1800 UC',  'amount' => 399000],
        ['id' => 6,  'label' => '3850 UC',  'amount' => 799000],
        ['id' => 7,  'label' => '8100 UC',  'amount' => 1599000],
    ];

    private array $genshinPackages = [
        ['id' => 1,  'label' => '60 Genesis Crystal',   'amount' => 15000],
        ['id' => 2,  'label' => '300 Genesis Crystal',  'amount' => 75000],
        ['id' => 3,  'label' => '980 Genesis Crystal',  'amount' => 230000],
        ['id' => 4,  'label' => '1980 Genesis Crystal', 'amount' => 459000],
        ['id' => 5,  'label' => '3280 Genesis Crystal', 'amount' => 749000],
        ['id' => 6,  'label' => '6480 Genesis Crystal', 'amount' => 1399000],
    ];

    private array $valorantPackages = [
        ['id' => 1,  'label' => '475 VP',   'amount' => 55000],
        ['id' => 2,  'label' => '1000 VP',  'amount' => 110000],
        ['id' => 3,  'label' => '2050 VP',  'amount' => 209000],
        ['id' => 4,  'label' => '3650 VP',  'amount' => 360000],
        ['id' => 5,  'label' => '5350 VP',  'amount' => 519000],
        ['id' => 6,  'label' => '11000 VP', 'amount' => 990000],
    ];

    private array $honkaiPackages = [
        ['id' => 1,  'label' => '60 Oneiric Shard',   'amount' => 15000],
        ['id' => 2,  'label' => '300 Oneiric Shard',  'amount' => 75000],
        ['id' => 3,  'label' => '980 Oneiric Shard',  'amount' => 229000],
        ['id' => 4,  'label' => '1980 Oneiric Shard', 'amount' => 449000],
        ['id' => 5,  'label' => '3280 Oneiric Shard', 'amount' => 729000],
        ['id' => 6,  'label' => '6480 Oneiric Shard', 'amount' => 1399000],
        ['id' => 7,  'label' => 'Express Pass',       'amount' => 69000],
    ];

    private array $codPackages = [
        ['id' => 1,  'label' => '80 CP',    'amount' => 16000],
        ['id' => 2,  'label' => '400 CP',   'amount' => 79000],
        ['id' => 3,  'label' => '800 CP',   'amount' => 149000],
        ['id' => 4,  'label' => '2000 CP',  'amount' => 349000],
        ['id' => 5,  'label' => '5000 CP',  'amount' => 799000],
        ['id' => 6,  'label' => '10000 CP', 'amount' => 1499000],
    ];

    private array $cocPackages = [
        ['id' => 1,  'label' => '80 Gems',    'amount' => 15000],
        ['id' => 2,  'label' => '500 Gems',   'amount' => 79000],
        ['id' => 3,  'label' => '1200 Gems',  'amount' => 169000],
        ['id' => 4,  'label' => '2500 Gems',  'amount' => 339000],
        ['id' => 5,  'label' => '6500 Gems',  'amount' => 849000],
        ['id' => 6,  'label' => '14000 Gems', 'amount' => 1699000],
    ];

    // ── Helpers ──────────────────────────────────────────────────────────────

    private function showPage(string $view, array $packages, string $gameName)
    {
        return view($view, [
            'user'     => Auth::user(),
            'packages' => $packages,
            'gameName' => $gameName,
        ]);
    }

    private function processTopup(Request $request, array $packages, string $gameName, string $routeBack)
    {
        $request->validate([
            'user_id_game' => ['required', 'string', 'max:100'],
            'package_id'   => ['required', 'integer'],
        ], [
            'user_id_game.required' => 'ID akun wajib diisi.',
            'package_id.required'   => 'Pilih paket terlebih dahulu.',
        ]);

        $user    = Auth::user();
        $package = collect($packages)->firstWhere('id', (int) $request->package_id);

        if (! $package) {
            return back()->with('error', 'Paket tidak ditemukan.');
        }

        if ($user->saldo < $package['amount']) {
            return back()->with('error', 'Saldo tidak mencukupi.')->withInput();
        }

        DB::transaction(function () use ($user, $package, $gameName, $request) {
            $user->decrement('saldo', $package['amount']);
            $user->refresh();

            Transaction::create([
                'user_id'        => $user->id,
                'game'           => $gameName,
                'item'           => $package['label'],
                'user_id_game'   => $request->user_id_game,
                'payment_method' => 'saldo',
                'admin_fee'      => 0,
                'amount'         => $package['amount'],
                'status'         => 'success',
            ]);

            SaldoHistory::create([
                'user_id'       => $user->id,
                'type'          => 'purchase',
                'description'   => 'Pembelian ' . $package['label'] . ' ' . $gameName,
                'amount'        => -$package['amount'],
                'balance_after' => $user->saldo,
                'status'        => 'success',
            ]);
        });

        return redirect()->route('dashboard')
            ->with('success', 'Top-up ' . $package['label'] . ' ' . $gameName . ' berhasil! 🎉');
    }

    // ── Mobile Legends ───────────────────────────────────────────────────────

    public function mobileLegends()
    {
        $user     = Auth::user();
        $packages = $this->mlPackages;
        return view('topup.mobile-legends', compact('user', 'packages'));
    }

    public function processMl(Request $request)
    {
        $request->validate([
            'user_id_game' => ['required', 'string', 'max:50'],
            'zone_id'      => ['required', 'string', 'max:20'],
            'package_id'   => ['required', 'integer'],
        ], [
            'user_id_game.required' => 'User ID wajib diisi.',
            'zone_id.required'      => 'Zone ID wajib diisi.',
            'package_id.required'   => 'Pilih paket terlebih dahulu.',
        ]);

        $user    = Auth::user();
        $package = collect($this->mlPackages)->firstWhere('id', (int) $request->package_id);

        if (! $package) return back()->with('error', 'Paket tidak ditemukan.');
        if ($user->saldo < $package['amount']) return back()->with('error', 'Saldo tidak mencukupi.')->withInput();

        DB::transaction(function () use ($user, $package, $request) {
            $user->decrement('saldo', $package['amount']);
            $user->refresh();

            Transaction::create([
                'user_id'        => $user->id,
                'game'           => 'Mobile Legends',
                'item'           => $package['label'],
                'user_id_game'   => $request->user_id_game . '/' . $request->zone_id,
                'payment_method' => 'saldo',
                'admin_fee'      => 0,
                'amount'         => $package['amount'],
                'status'         => 'success',
            ]);

            SaldoHistory::create([
                'user_id'       => $user->id,
                'type'          => 'purchase',
                'description'   => 'Pembelian ' . $package['label'] . ' Mobile Legends',
                'amount'        => -$package['amount'],
                'balance_after' => $user->saldo,
                'status'        => 'success',
            ]);
        });

        return redirect()->route('dashboard')->with('success', 'Top-up ' . $package['label'] . ' Mobile Legends berhasil! 🎉');
    }

    // ── Free Fire ────────────────────────────────────────────────────────────

    public function freeFire()
    {
        return $this->showPage('topup.free-fire', $this->ffPackages, 'Free Fire');
    }

    public function processFf(Request $request)
    {
        return $this->processTopup($request, $this->ffPackages, 'Free Fire', 'topup.ff');
    }

    // ── PUBG Mobile ──────────────────────────────────────────────────────────

    public function pubg()
    {
        return $this->showPage('topup.pubg', $this->pubgPackages, 'PUBG Mobile');
    }

    public function processPubg(Request $request)
    {
        return $this->processTopup($request, $this->pubgPackages, 'PUBG Mobile', 'topup.pubg');
    }

    // ── Genshin Impact ───────────────────────────────────────────────────────

    public function genshin()
    {
        return $this->showPage('topup.genshin', $this->genshinPackages, 'Genshin Impact');
    }

    public function processGenshin(Request $request)
    {
        return $this->processTopup($request, $this->genshinPackages, 'Genshin Impact', 'topup.genshin');
    }

    // ── Valorant ─────────────────────────────────────────────────────────────

    public function valorant()
    {
        return $this->showPage('topup.valorant', $this->valorantPackages, 'Valorant');
    }

    public function processValorant(Request $request)
    {
        return $this->processTopup($request, $this->valorantPackages, 'Valorant', 'topup.valorant');
    }

    // ── Honkai: Star Rail ─────────────────────────────────────────────────────

    public function honkaiSr()
    {
        return $this->showPage('topup.honkai-sr', $this->honkaiPackages, 'Honkai: Star Rail');
    }

    public function processHonkai(Request $request)
    {
        return $this->processTopup($request, $this->honkaiPackages, 'Honkai: Star Rail', 'topup.honkai');
    }

    // ── COD Mobile ───────────────────────────────────────────────────────────

    public function cod()
    {
        return $this->showPage('topup.cod', $this->codPackages, 'COD Mobile');
    }

    public function processCod(Request $request)
    {
        return $this->processTopup($request, $this->codPackages, 'COD Mobile', 'topup.cod');
    }

    // ── Clash of Clans ───────────────────────────────────────────────────────

    public function coc()
    {
        return $this->showPage('topup.coc', $this->cocPackages, 'Clash of Clans');
    }

    public function processCoc(Request $request)
    {
        return $this->processTopup($request, $this->cocPackages, 'Clash of Clans', 'topup.coc');
    }
}
