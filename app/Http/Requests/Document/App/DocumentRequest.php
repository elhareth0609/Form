<?php

namespace App\Http\Requests\Document\App;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest {
    public function rules() {
        return [
            'id' => $this->routeIs('document.update') ? 'required|exists:documents' : '',
            'file' => $this->routeIs('document.create') ? 'required|file' : 'nullable|file',
            'name' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
