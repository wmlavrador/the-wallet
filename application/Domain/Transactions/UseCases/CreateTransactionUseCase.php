<?php

namespace TheWallet\Transactions\UseCases;

use Exception;
use Illuminate\Support\Facades\DB;
use TheWallet\Jobs\NotificationsQueue;
use TheWallet\PaymentsAuthorizer\PaymentsAuthorizerContract;
use TheWallet\Transactions\DataTransferObject\TransactionData;
use TheWallet\Transactions\Repository\TransactionRepository;
use TheWallet\Transactions\TransactionException;
use TheWallet\Users\Enum\UserTypeEnum;
use TheWallet\Wallets\Repository\WalletRepository;
use TheWallet\Wallets\Wallet;

class CreateTransactionUseCase
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly WalletRepository $walletRepository,
        private readonly PaymentsAuthorizerContract $paymentsAuthorizer
    ){}

    /**
     * @throws Exception
     */
    public function handle(TransactionData $transactionData): TransactionData
    {
        $walletSender = $this->walletRepository->getWalletById($transactionData->sender);
        $this->validateTransferRules($walletSender, $transactionData);

        $this->makeTransferBetweebWallets($transactionData, $walletSender);
        $this->notifyTransactionCreated();

        return $transactionData;
    }

    /**
     * @throws TransactionException
     */
    private function validateTransferRules(Wallet $walletSender, TransactionData $transactionData): void
    {
        if ($walletSender->user->user_type === UserTypeEnum::Company->value) {
            throw TransactionException::companiesCannotTransfer();
        }

        if ($transactionData->value <= 0) {
            throw TransactionException::negativeValuesNotAllowed();
        }

        if (!$walletSender->hasBalance($transactionData->value)) {
            throw TransactionException::hasNoBalance();
        }

        if ($walletSender->getKey() === $transactionData->receiver) {
            throw TransactionException::matchingWalletsNotAllowed();
        }
    }

    private function makeTransferBetweebWallets(TransactionData $transactionData, Wallet $walletSender): void
    {
        DB::transaction(function() use ($transactionData, $walletSender) {
            if (!$this->paymentsAuthorizer->isAuthorizerPayment()) {
                throw TransactionException::transactionNotAllowedByThirdy();
            }

            $this->transactionRepository->createTransaction($transactionData);
            $walletReceiver = $this->walletRepository->getWalletById($transactionData->receiver);

            $this->walletRepository->decreaseBalance($walletSender, $transactionData->value);
            $this->walletRepository->increaseBalance($walletReceiver, $transactionData->value);
        });
    }

    private function notifyTransactionCreated(): void
    {
        //NotificationsQueue::dispatch('Transaction Created with Successfuly');
    }
}
