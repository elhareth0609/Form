<?php

namespace App\Http\Controllers;

use App\Http\Requests\Record\App\RecordRequest;
use App\Http\Resources\Record\App\RecordResource;
use App\Services\RecordService;
use App\Traits\ApiResponder;

class RecordController extends Controller {
    use ApiResponder;

    private $recordService;

    public function __construct(RecordService $recordService) {
        $this->recordService = $recordService;
    }

    public function get($id) {
        try {
            $car = $this->recordService->getRecord($id);
            return $this->success(new RecordResource($car));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(RecordRequest $request) {
        try {
            $car = $this->recordService->createRecord($request->validated());
            return $this->success(new RecordResource($car), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(RecordRequest $request, $id) {
        try {
            $car = $this->recordService->updateRecord($id, $request->validated());
            return $this->success(new RecordResource($car), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->recordService->deleteRecord($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
