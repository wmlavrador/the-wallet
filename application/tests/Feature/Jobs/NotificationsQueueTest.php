<?php

namespace Jobs;

use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use TheWallet\Notifications\Jobs\NotificationsQueue;
use TheWallet\Notifications\NotificationContract;
use TheWallet\Notifications\NotificationsException;

class NotificationsQueueTest extends TestCase
{
    private NotificationsQueue $notificationsQueue;

    private MockObject $notificationServiceMock;

    protected function setUp(): void
    {
        $this->notificationServiceMock = $this->getMockBuilder(NotificationContract::class)->getMock();
        $this->notificationsQueue = new NotificationsQueue('Test message');
    }

    public function testHandleCallsNotificationServiceWithTextMessage()
    {
        $this->notificationServiceMock->expects($this->once())
            ->method('sendText')
            ->with('Test message')
            ->willReturn(true);

        $this->notificationsQueue->handle($this->notificationServiceMock);
    }

    public function testHandleThrowsExceptionWhenNotificationNotSent()
    {
        $this->notificationServiceMock->expects($this->once())
            ->method('sendText')
            ->willReturn(false);

        $this->expectException(NotificationsException::class);
        $this->expectExceptionMessage('Notification service not responding, tray again.');

        $this->notificationsQueue->handle($this->notificationServiceMock);
    }
}
