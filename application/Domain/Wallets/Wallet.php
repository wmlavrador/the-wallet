<?php

namespace TheWallet\Wallets;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TheWallet\Transactions\Transaction;
use TheWallet\Users\User;

class Wallet extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'wallets';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function newFactory(): WalletFactory
    {
        return WalletFactory::new();
    }

    public function hasBalance(int $decreaseValue): bool
    {
        return ($this->balance > $decreaseValue);
    }

    public function wasSent(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender', 'id');
    }

    public function wasRecived(): HasMany
    {
        return $this->hasMany(Transaction::class, 'receiver', 'id');
    }
}
