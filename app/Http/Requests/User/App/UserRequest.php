<?php

namespace App\Http\Requests\User\App;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function rules() {
        return [
            'id' => $this->routeIs('user.update')? 'required|exists:users' : '',
            'first_name' => 'required|string',
            'phone' => 'required|string',
            'email' => $this->routeIs('user.update') ? 'nullable|email|unique:users,email,' . $this->id : 'required|email|unique:users,email',
            'password' => $this->routeIs('user.create') ? 'required|string|min:8' : '',
            'confirm_password' => 'required_with:password|same:password',
        ];
    }
}
