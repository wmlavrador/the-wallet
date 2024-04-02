<?php

namespace TheWallet\Notifications\Enum;

enum NotificationsImplementedEnum: string
{
    case SMS = 'sms';
    case SendGrid = 'sendgrid';
}
