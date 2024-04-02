<?php

namespace TheWallet\Notifications\Providers\SMS;

use TheWallet\Notifications\NotificationContract;

class SMSClient implements NotificationContract
{
    public function sendText($message): bool
    {
        return true;
    }
}
