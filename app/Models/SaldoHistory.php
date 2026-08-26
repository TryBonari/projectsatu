<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoHistory extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'amount',
        'balance_after',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount'        => 'integer',
            'balance_after' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Label tipe yang readable
    public function typeLabel(): string
    {
        return match($this->type) {
            'topup'    => 'Top Up',
            'purchase' => 'Pembelian',
            'refund'   => 'Refund',
            default    => ucfirst($this->type),
        };
    }

    // Apakah transaksi masuk (positif)?
    public function isCredit(): bool
    {
        return $this->amount > 0;
    }
}
