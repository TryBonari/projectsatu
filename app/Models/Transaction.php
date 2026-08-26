<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'game',
        'item',
        'user_id_game',
        'payment_method',
        'admin_fee',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount'    => 'integer',
            'admin_fee' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Total yang dibayar user (amount + admin_fee)
    public function totalAmount(): int
    {
        return $this->amount + ($this->admin_fee ?? 0);
    }

    // Label status yang readable
    public function statusLabel(): string
    {
        return match($this->status) {
            'success'    => 'Sukses',
            'pending'    => 'Menunggu',
            'processing' => 'Diproses',
            'failed'     => 'Gagal',
            default      => ucfirst($this->status),
        };
    }

    // CSS class badge berdasarkan status
    public function statusClass(): string
    {
        return match($this->status) {
            'success'    => 'badge-success',
            'pending'    => 'badge-pending',
            'processing' => 'badge-processing',
            'failed'     => 'badge-failed',
            default      => 'badge-pending',
        };
    }

    // Label metode pembayaran
    public function paymentLabel(): string
    {
        return match($this->payment_method) {
            'saldo' => 'Saldo Akun',
            'qris'  => 'QRIS',
            'va'    => 'Virtual Account',
            default => ucfirst($this->payment_method ?? 'Saldo Akun'),
        };
    }

    // Nomor transaksi dengan format INV-YYYYMMDD-{id}
    public function invoiceNumber(): string
    {
        return 'INV-' . $this->created_at->format('Ymd') . '-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}
