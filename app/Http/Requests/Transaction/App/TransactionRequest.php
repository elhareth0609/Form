<?php

namespace App\Http\Requests\Transaction\App;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest {
    public function rules() {
        return [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            // 'status' => 'required|in:active,inactive',
            'id' => $this->routeIs('.update') ? 'required|exists:transactions' : '',
        ];
    }
}
