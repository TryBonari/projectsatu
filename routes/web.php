<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// ── Root ─────────────────────────────────────────────────────────────────────
Route::get('/', fn () => redirect()->route('login'));

// ── Legal (publik) ───────────────────────────────────────────────────────────
Route::get('/terms',   fn () => view('terms'))->name('terms');
Route::get('/privacy', fn () => view('privacy'))->name('privacy');

// ── Auth ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Protected ────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── Transaksi ─────────────────────────────────────────────────────────────
    Route::get('/transaksi',       [TransactionController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}',  [TransactionController::class, 'show'])->name('transaksi.show')->whereNumber('id');

    // ── Saldo ────────────────────────────────────────────────────────────────
    Route::get ('/saldo',            [SaldoController::class, 'index'])->name('saldo');
    Route::post('/saldo/qris',       [SaldoController::class, 'showQris'])->name('saldo.qris');
    Route::post('/saldo/confirm',    [SaldoController::class, 'confirmTopup'])->name('saldo.confirm');

    // ── Top-up ───────────────────────────────────────────────────────────────
    Route::get ('/topup/mobile-legends', [TopupController::class, 'mobileLegends'])->name('topup.ml');
    Route::post('/topup/mobile-legends', [TopupController::class, 'processMl'])->name('topup.ml.process');

    Route::get ('/topup/free-fire',      [TopupController::class, 'freeFire'])->name('topup.ff');
    Route::post('/topup/free-fire',      [TopupController::class, 'processFf'])->name('topup.ff.process');

    Route::get ('/topup/pubg',           [TopupController::class, 'pubg'])->name('topup.pubg');
    Route::post('/topup/pubg',           [TopupController::class, 'processPubg'])->name('topup.pubg.process');

    Route::get ('/topup/genshin',        [TopupController::class, 'genshin'])->name('topup.genshin');
    Route::post('/topup/genshin',        [TopupController::class, 'processGenshin'])->name('topup.genshin.process');

    Route::get ('/topup/valorant',       [TopupController::class, 'valorant'])->name('topup.valorant');
    Route::post('/topup/valorant',       [TopupController::class, 'processValorant'])->name('topup.valorant.process');

    Route::get ('/topup/honkai-sr',      [TopupController::class, 'honkaiSr'])->name('topup.honkai');
    Route::post('/topup/honkai-sr',      [TopupController::class, 'processHonkai'])->name('topup.honkai.process');

    Route::get ('/topup/cod',            [TopupController::class, 'cod'])->name('topup.cod');
    Route::post('/topup/cod',            [TopupController::class, 'processCod'])->name('topup.cod.process');

    Route::get ('/topup/coc',            [TopupController::class, 'coc'])->name('topup.coc');
    Route::post('/topup/coc',            [TopupController::class, 'processCoc'])->name('topup.coc.process');
});
