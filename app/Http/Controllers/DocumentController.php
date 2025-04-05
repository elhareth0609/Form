<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\App\DocumentRequest;
use App\Http\Resources\Document\App\DocumentResource;
use App\Services\DocumentService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class DocumentController extends Controller {
    use ApiResponder;

    private $documentService;

    public function __construct(DocumentService $documentService) {
        $this->documentService = $documentService;
    }

    public function get($id) {
        try {
            $car = $this->documentService->getDocument($id);
            return $this->success(new DocumentResource($car));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(DocumentRequest $request) {
        try {
            $car = $this->documentService->createDocument($request->validated());
            return $this->success(new DocumentResource($car), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(DocumentRequest $request, $id) {
        try {
            $car = $this->documentService->updateDocument($id, $request->validated());
            return $this->success(new DocumentResource($car), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->documentService->deleteDocument($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
