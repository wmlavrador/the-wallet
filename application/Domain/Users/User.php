<?php

namespace TheWallet\Users;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TheWallet\Users\Enum\UserTypeEnum;
use TheWallet\Wallets\Wallet;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    public $incrementing = false;

    protected $fillable = [
        'document_number',
        'user_type',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'user_type' => UserTypeEnum::class
        ];
    }

    public static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }
}
