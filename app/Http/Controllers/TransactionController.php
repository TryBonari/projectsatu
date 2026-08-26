<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // ── Daftar transaksi dengan filter + search + paginate ────────────────────

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Transaction::where('user_id', $user->id)->latest();

        // Filter status
        if ($request->filled('status') && in_array($request->status, ['success', 'pending', 'processing', 'failed'])) {
            $query->where('status', $request->status);
        }

        // Filter rentang tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Pencarian ID transaksi atau nama game
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('game', 'like', '%' . $search . '%')
                  ->orWhere('item', 'like', '%' . $search . '%');
            });
        }

        $transactions = $query->paginate(15)->withQueryString();

        // Statistik ringkas
        $stats = [
            'total'   => Transaction::where('user_id', $user->id)->count(),
            'success' => Transaction::where('user_id', $user->id)->where('status', 'success')->count(),
            'pending' => Transaction::where('user_id', $user->id)->whereIn('status', ['pending', 'processing'])->count(),
            'spent'   => Transaction::where('user_id', $user->id)->where('status', 'success')->sum('amount'),
        ];

        return view('transaksi.index', compact('user', 'transactions', 'stats'));
    }

    // ── Detail transaksi (hanya milik user sendiri) ───────────────────────────

    public function show(int $id)
    {
        $user = Auth::user();

        // Authorization: pastikan transaksi milik user yang sedang login
        $transaction = Transaction::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('transaksi.show', compact('user', 'transaction'));
    }
}
