<?php

namespace App\Http\Resources\Document\App;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'file' => $this->documentUrl,
            'status' => $this->status
        ];
    }
}
