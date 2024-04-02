<?php

namespace TheWallet\Transactions\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use TheWallet\Users\Http\Resources\UserResource;

class TransactionsCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'sender' => $transaction->sender,
                'receiver' => $transaction->receiver,
                'receiverDetails' => new UserResource($transaction->walletReceiver->user),
                'value' => $transaction->value,
                'situation' => $transaction->situation
            ];
        })->toArray();
    }
}
