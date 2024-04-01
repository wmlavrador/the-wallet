<?php

namespace TheWallet\Transactions;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use TheWallet\Users\User;

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

    public function userSender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender');
    }

    public function userReceiver(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'receiver');
    }
}
