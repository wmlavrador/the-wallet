<?php

namespace TheWallet\Notifications;

use Exception;

class NotificationsException extends Exception
{
    public static function notificationNotImplemented(): self
    {
        return new self('Notification service is not implemented.');
    }

    public static function notificationNotSent(): self
    {
        return new self('Notification service not responding, tray again.');
    }
}
