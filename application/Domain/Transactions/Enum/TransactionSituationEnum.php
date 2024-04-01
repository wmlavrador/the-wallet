<?php

namespace TheWallet\Transactions\Enum;

enum TransactionSituationEnum: string
{
    case Awaiting = 'awaiting';
    case Approved = 'approved';
    case Fail = 'fail';
}
