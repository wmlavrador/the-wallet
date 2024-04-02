<?php

namespace TheWallet\Transactions;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use TheWallet\Wallets\Wallet;

class Transaction extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'transactions';

    public $incrementing = false;

    protected $fillable = [
        'sender',
        'receiver',
        'value',
        'situation'
    ];

    public static function newFactory(): TransactionFactory
    {
        return TransactionFactory::new();
    }

    public function walletSender(): HasOne
    {
        return $this->hasOne(Wallet::class, 'id', 'sender');
    }

    public function walletReceiver(): HasOne
    {
        return $this->hasOne(Wallet::class,'id', 'receiver');
    }
}
