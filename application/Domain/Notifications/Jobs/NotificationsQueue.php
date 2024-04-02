<?php

namespace TheWallet\Notifications\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use TheWallet\Notifications\NotificationContract;
use TheWallet\Notifications\NotificationsException;

class NotificationsQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(
        private readonly string $textMessage
    ){}

    /**
     * @throws Exception
     */
    public function handle(NotificationContract $notificationService): void
    {
        $notified = $notificationService->sendText($this->textMessage);
        $this->checkMessageSend($notified);
    }

    /**
     * @throws Exception
     */
    private function checkMessageSend($notified): void
    {
        if (!$notified) {
            throw NotificationsException::notificationNotSent();
        }
    }
}
