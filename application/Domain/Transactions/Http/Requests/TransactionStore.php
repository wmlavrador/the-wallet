<?php

namespace TheWallet\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TheWallet\Transactions\DataTransferObject\TransactionData;

class TransactionStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value' => 'required|integer',
            'sender' => 'required|string|exists:wallets,id',
            'receiver' => 'required|string|exists:wallets,id|different:sender',
        ];
    }

    public function toDto(): TransactionData
    {
        return new TransactionData(
            value: $this->input('value'),
            sender: $this->input('sender'),
            receiver: $this->input('receiver')
        );
    }
}
