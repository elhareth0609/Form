<?php

namespace App\Repositories;

use App\Interfaces\DocumentRepositoryInterface;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface {
    private $document;

    public function __construct(Document $document) {
        $this->document = $document;
    }

    public function find($id) {
        return $this->document->findOrFail($id);
    }

    public function create(array $data) {
        return $this->document->create($data);
    }

    public function update($id, array $data) {
        $document = $this->find($id);
        $document->update($data);
        return $document;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }

}
