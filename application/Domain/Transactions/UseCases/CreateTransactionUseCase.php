<?php

namespace TheWallet\Transactions\UseCases;

use Illuminate\Support\Facades\DB;
use TheWallet\PaymentsAuthorizer\PaymentAuthorizerFactory;
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
     * @throws \Exception
     */
    public function handle(TransactionData $transactionData): void
    {
        $walletSender = $this->walletRepository->getWalletById($transactionData->sender);
        $this->validateTransferRules($walletSender, $transactionData);

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

    private function validateTransferRules(Wallet $walletSender, TransactionData $transactionData): void
    {
        if ($walletSender->user && $walletSender->user->user_type === UserTypeEnum::Company->value) {
            throw new \Exception('Seu perfil é de Empresa por enquanto não é permitido enviar valores.');
        }

        if ($transactionData->value <= 0) {
            throw new \Exception('Transação não permitida');
        }

        if (!$walletSender->hasBalance($transactionData->value)) {
            throw new \Exception('Você não possui saldo para realizar a transferência.');
        }

        if ($walletSender->getKey() === $transactionData->receiver) {
            throw new \Exception('Você não pode enviar fundos para sua própria carteira.');
        }
    }
}
