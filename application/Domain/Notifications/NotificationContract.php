<?php

namespace TheWallet\Notifications;

interface NotificationContract
{
    public function sendText($message): bool;
}
