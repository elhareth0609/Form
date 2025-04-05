<?php

namespace App\Repositories;

use App\Interfaces\RecordRepositoryInterface;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;

class RecordRepository implements RecordRepositoryInterface {
    private $record;
    private $user_id;

    public function __construct(Record $record) {
        $this->record = $record;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->record->findOrFail($id);
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->record->create($data);
    }

    public function update($id, array $data) {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
