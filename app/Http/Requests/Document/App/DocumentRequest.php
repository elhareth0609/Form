<?php

namespace App\Http\Requests\Document\App;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest {
    public function rules() {
        return [
            'id' => $this->isMethod('PUT') ? 'required|exists:documents' : '',
            'file' => 'required|file',
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
