<?php

namespace App\Http\Resources\Record\App;

use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'employment_year' => $this->employment_year,
            'employment_rank' => $this->employment_rank,
            'status' => $this->status,
        ];
    }
}
