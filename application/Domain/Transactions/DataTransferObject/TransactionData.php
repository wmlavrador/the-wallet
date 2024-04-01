<?php

namespace TheWallet\Transactions\DataTransferObject;

use TheWallet\Transactions\Enum\TransactionSituationEnum;

readonly class TransactionData
{
    public function __construct(
        public int $value,
        public string $sender,
        public string $receiver,
        public TransactionSituationEnum $situation = TransactionSituationEnum::Awaiting
    ) {
    }
}
