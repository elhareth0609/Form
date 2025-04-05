<?php

namespace App\Services;

use App\Interfaces\RecordRepositoryInterface;

class recordService {
    private $recordRepository;

    public function __construct(RecordRepositoryInterface $recordRepository) {
        $this->recordRepository = $recordRepository;
    }

    public function getrecord($id) {
        return $this->recordRepository->find($id);
    }

    public function createrecord(array $data) {
        return $this->recordRepository->create($data);
    }

    public function updaterecord($id, array $data) {
        return $this->recordRepository->update($id, $data);
    }

    public function deleterecord($id) {
        return $this->recordRepository->delete($id);
    }
}
