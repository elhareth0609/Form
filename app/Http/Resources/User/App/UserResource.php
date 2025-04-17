<?php

namespace App\Http\Resources\User\App;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'full_name' => $this->full_name,
            'name' => $this->full_name
        ];
    }
}
