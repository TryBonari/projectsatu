<?php

namespace App\Http\Controllers;

use App\Models\SaldoHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    // ── Tampilkan halaman saldo ──────────────────────────────────────────────

    public function index()
    {
        $user = Auth::user();

        $histories = SaldoHistory::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $totalTopup = SaldoHistory::where('user_id', $user->id)
            ->where('type', 'topup')->where('status', 'success')
            ->sum('amount');

        $totalPurchase = SaldoHistory::where('user_id', $user->id)
            ->where('type', 'purchase')->where('status', 'success')
            ->sum('amount');

        return view('saldo', compact('user', 'histories', 'totalTopup', 'totalPurchase'));
    }

    // ── Tampilkan halaman QRIS ───────────────────────────────────────────────
    // Dipanggil saat user klik "Top Up" dari halaman saldo

    public function showQris(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'integer', 'min:10000', 'max:10000000'],
        ], [
            'amount.required' => 'Nominal wajib diisi.',
            'amount.integer'  => 'Nominal harus berupa angka.',
            'amount.min'      => 'Minimal top up Rp 10.000.',
            'amount.max'      => 'Maksimal top up Rp 10.000.000.',
        ]);

        $user   = Auth::user();
        $amount = (int) $request->amount;

        // Simpan nominal ke session agar aman saat konfirmasi
        session(['topup_pending_amount' => $amount]);

        // URL QRIS dinamis via api.qrserver.com — encode string pembayaran
        $qrisData   = 'NexaTopUp|' . $user->id . '|' . $amount . '|' . now()->timestamp;
        $qrisUrl    = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode($qrisData);

        return view('saldo-qris', compact('user', 'amount', 'qrisUrl'));
    }

    // ── Konfirmasi pembayaran & kredit saldo ─────────────────────────────────

    public function confirmTopup(Request $request)
    {
        $amount = session('topup_pending_amount');

        if (! $amount || $amount < 10000) {
            return redirect()->route('saldo')->with('error', 'Sesi top up tidak valid. Silakan coba lagi.');
        }

        $user = Auth::user();

        DB::transaction(function () use ($user, $amount) {
            $user->increment('saldo', $amount);
            $user->refresh();

            SaldoHistory::create([
                'user_id'       => $user->id,
                'type'          => 'topup',
                'description'   => 'Top Up Saldo via QRIS',
                'amount'        => $amount,
                'balance_after' => $user->saldo,
                'status'        => 'success',
            ]);
        });

        // Hapus session setelah digunakan
        session()->forget('topup_pending_amount');

        return redirect()->route('saldo')
            ->with('success', 'Top up Rp ' . number_format($amount, 0, ',', '.') . ' berhasil dikonfirmasi! 🎉');
    }
}
