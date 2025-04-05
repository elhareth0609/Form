<?php

namespace App\Services;

use App\Interfaces\DocumentRepositoryInterface;

class DocumentService {
    private $documentRepository;


    public function __construct(DocumentRepositoryInterface $documentRepository) {
        $this->documentRepository = $documentRepository;
    }

    public function getDocument($id) {
        return $this->documentRepository->find($id);
    }

    // public function allDocument() {
    //     return $this->documentRepository->all();
    // }

    // public function activedDocument() {
    //     return $this->documentRepository->actived();
    // }

    public function createDocument(array $data) {
        return $this->documentRepository->create($data);
    }

    public function updateDocument($id, array $data) {
        return $this->documentRepository->update($id, $data);
    }

    public function deleteDocument($id) {
        return $this->documentRepository->delete($id);
    }
}
