<?php

namespace TheWallet\Transactions;

class TransactionException extends \Exception
{
    public static function transactionNotAllowedByThirdy(): self
    {
        return new self('Your Transaction was not authorized.');
    }

    public static function companiesCannotTransfer(): self
    {
        return new self('Your profile is that of a Company and for now it is not allowed to send values.');
    }

    public static function negativeValuesNotAllowed(): self
    {
        return new self('Negative Values Not Allowed.');
    }

    public static function hasNoBalance(): self
    {
        return new self('You do not have a balance to make the transfer.');
    }

    public static function matchingWalletsNotAllowed(): self
    {
        return new self('You cannot send funds to your own wallet.');
    }
}
