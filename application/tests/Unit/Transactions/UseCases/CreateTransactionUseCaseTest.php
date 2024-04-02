<?php

namespace Tests\Unit\Transactions\UseCases;

use Tests\TestCase;
use TheWallet\Jobs\NotificationsQueue;
use TheWallet\PaymentsAuthorizer\PaymentsAuthorizerContract;
use TheWallet\Transactions\Repository\TransactionRepository;
use TheWallet\Transactions\TransactionException;
use TheWallet\Transactions\UseCases\CreateTransactionUseCase;
use TheWallet\Transactions\DataTransferObject\TransactionData;
use TheWallet\Users\Enum\UserTypeEnum;
use TheWallet\Wallets\Repository\WalletRepository;
use TheWallet\Wallets\Wallet;

class CreateTransactionUseCaseTest extends TestCase
{
    private WalletRepository $walletRepositoryMock;
    private PaymentsAuthorizerContract $paymentAuthorizerMock;
    private CreateTransactionUseCase $transactionUseCaseMock;

    public function setUp(): void
    {
        parent::setUp();

        $transactionRepositoryMock = $this->createMock(TransactionRepository::class);
        $this->walletRepositoryMock = $this->createMock(WalletRepository::class);
        $this->paymentAuthorizerMock = $this->createMock(PaymentsAuthorizerContract::class);

        $this->notificationsQueueMock = $this->getMockBuilder(NotificationsQueue::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionUseCaseMock = new CreateTransactionUseCase(
            $transactionRepositoryMock,
            $this->walletRepositoryMock,
            $this->paymentAuthorizerMock
        );
    }

    public function testTransactionIsNotAuthorizedByThirdy()
    {
        $this->paymentAuthorizerMock->method('isAuthorizerPayment')
            ->willReturn(false);

        $walletSender = new Wallet();
        $walletSender->balance = 1999;
        $walletSender->user = (object) ['user_type' => UserTypeEnum::Customer->value];
        $walletSender->id = fake()->uuid();

        $this->walletRepositoryMock->method('getWalletById')
            ->willReturn($walletSender);

        $transactionData = new TransactionData(
            value: 123,
            sender: fake()->uuid(),
            receiver: fake()->uuid()
        );

        $this->expectException(TransactionException::class);
        $this->transactionUseCaseMock->handle($transactionData);
    }

    public function testCreateTransactionSuccessfuly()
    {
        $this->paymentAuthorizerMock->method('isAuthorizerPayment')
            ->willReturn(true);

        $walletSender = new Wallet();
        $walletSender->balance = 1999;
        $walletSender->user = (object) ['user_type' => UserTypeEnum::Customer->value];
        $walletSender->id = fake()->uuid();

        $this->walletRepositoryMock->method('getWalletById')
            ->willReturn($walletSender);

        $transactionData = new TransactionData(
            value: 123,
            sender: fake()->uuid(),
            receiver: fake()->uuid()
        );

        $this->notificationsQueueMock->method('dispatch')
            ->with('Transaction Created with Successfuly');

        $this->transactionUseCaseMock->handle($transactionData);
        $this->assertEquals($transactionData, $this->transactionUseCaseMock->handle($transactionData));
    }
}
