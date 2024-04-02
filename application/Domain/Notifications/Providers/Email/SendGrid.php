<?php

namespace TheWallet\Notifications\Providers\Email;

use TheWallet\Notifications\NotificationContract;

class SendGrid implements NotificationContract
{

    public function sendText($message): bool
    {
        return true;
    }
}
