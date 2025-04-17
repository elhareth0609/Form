<?php

namespace App\Http\Requests\Record\App;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RecordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => $this->routeIs('record.update') ? 'required|exists:records' : '',
            // 'user_id' => $this->isMethod('PUT') ? 'required|exists:users,id' : Auth::user()->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'employment_year' => 'required|integer',
            'employment_rank' => 'required|string',
            'status' => 'sometimes|in:accepted,rejected,in progress',
        ];
    }
}
