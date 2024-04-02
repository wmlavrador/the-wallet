<?php

namespace TheWallet\Transactions\DataTransferObject;

readonly class WalletsTransactionData
{
    public function __construct(
        public string $sender,
        public string $receiver
    ){}
}
