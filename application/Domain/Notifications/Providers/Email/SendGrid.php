<?php

namespace TheWallet\Notifications\Providers\Email;

use Illuminate\Support\Facades\Http;
use TheWallet\Notifications\NotificationContract;

class SendGrid implements NotificationContract
{
    private readonly string $apiUrl;

    public function __construct(){
        $this->apiUrl = config('services.notifications_service.sendgrid.api_url');
    }

    public function sendText($message): bool
    {
        return Http::get($this->apiUrl)->json('message') === true;
    }
}
