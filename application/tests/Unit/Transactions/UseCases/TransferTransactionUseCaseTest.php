<?php

namespace Tests\Unit\Transactions\UseCases;

use Tests\TestCase;
use TheWallet\Transactions\Repository\TransactionRepository;
use TheWallet\Transactions\UseCases\TransferTransactionUseCase;
use TheWallet\Transactions\DataTransferObject\TransactionData;
use TheWallet\Wallets\Repository\WalletRepository;
use TheWallet\Wallets\Wallet;

class TransferTransactionUseCaseTest extends TestCase
{
    private TransactionRepository $transactionRepositoryMock;
    private WalletRepository $walletRepositoryMock;
    private TransferTransactionUseCase $transactionUseCaseMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->transactionRepositoryMock = $this->createMock(TransactionRepository::class);
        $this->walletRepositoryMock = $this->createMock(WalletRepository::class);

        $this->transactionUseCaseMock = new TransferTransactionUseCase(
            $this->transactionRepositoryMock,
            $this->walletRepositoryMock
        );
    }

    public function testTransferTransaction()
    {
        $this->transactionRepositoryMock->expects($this->once())
            ->method('createTransaction');

        $this->walletRepositoryMock->method('getWalletById')
            ->willReturn((new Wallet()));

        $this->walletRepositoryMock->expects($this->exactly(1))
            ->method('decreaseBalance');

        $this->walletRepositoryMock->expects($this->exactly(1))
            ->method('increaseBalance');

        $transactionData = new TransactionData(
            value: 123,
            sender: fake()->uuid(),
            receiver: fake()->uuid()
        );

        $this->transactionUseCaseMock->handle($transactionData);
    }
}
