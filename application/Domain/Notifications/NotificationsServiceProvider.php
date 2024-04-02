<?php

namespace TheWallet\Notifications;

use Illuminate\Notifications\NotificationServiceProvider;
use TheWallet\Notifications\Enum\NotificationsImplementedEnum;
use TheWallet\Notifications\Providers\Email\SendGrid;
use TheWallet\Notifications\Providers\SMS\SMSClient;

class NotificationsServiceProvider extends NotificationServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(NotificationContract::class, function($app){
           $notificationDefault = $app['config']['services.notifications_service.default'];

           return match ($notificationDefault) {
               NotificationsImplementedEnum::SMS->value => new SMSClient(),
               NotificationsImplementedEnum::SendGrid->value => new SendGrid(),
               default => throw NotificationsException::notificationNotImplemented()
           };

        });
    }
}
