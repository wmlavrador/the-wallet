<?php

namespace TheWallet\Transactions;

use Illuminate\Validation\ValidationException;

class TransactionException extends ValidationException
{
    public static function transactionNotAllowedByThirdy(): self
    {
        return self::withMessages(['Your Transaction was not authorized by Thirdy.']);
    }

    public static function companiesCannotTransfer(): self
    {
        return self::withMessages([
            'Your profile is that of a Company and for now it is not allowed to send values.'
        ]);
    }

    public static function negativeValuesNotAllowed(): self
    {
        return self::withMessages(['Negative Values Not Allowed.']);
    }

    public static function hasNoBalance(): self
    {
        return self::withMessages(['You do not have a balance to make the transfer.']);
    }

    public static function matchingWalletsNotAllowed(): self
    {
        return self::withMessages(['You cannot send funds to your own wallet.']);
    }
}
