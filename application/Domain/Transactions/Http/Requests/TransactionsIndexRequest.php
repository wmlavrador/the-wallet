<?php

namespace TheWallet\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TheWallet\Transactions\DataTransferObject\WalletsTransactionData;

class TransactionsIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sender' => 'required|string',
            'receiver' => 'required|string'
        ];
    }

    public function toDto()
    {
        return new WalletsTransactionData(
            sender: $this->input('sender'),
            receiver: $this->input('receiver')
        );
    }
}
