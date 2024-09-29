<?php

namespace App\Services;

use App\Http\Requests\OpeningStoreRequest;
use App\Models\Store;
use App\Models\StoreSchedule;

class OpeningService
{
    protected $storeModel;

    protected $storeScheduleModel;

    public function __construct(Store $storeModel, StoreSchedule $storeScheduleModel)
    {
        $this->storeModel = $storeModel;
        $this->storeScheduleModel = $storeScheduleModel;
    }

    public function getAllOpening()
    {
        return StoreSchedule::with('store')->get();
    }

    public function getOpeningStore($storeId)
    {
        $store = $this->storeScheduleModel->where('store_id', $storeId)->get();

        return $store ?? [];
    }

    public function createOpening(int $storeId, array $request)
    {
        StoreSchedule::create(array_merge(['store_id' => $storeId], $request));
    }

    public function findStoreId($storeId)
    {
        return Store::find($storeId);
    }

    public function updateOpening($id, $storeId, OpeningStoreRequest $request)
    {
        return StoreSchedule::where(['store_id' => $storeId, 'id' => $id])->update($request->validated());
    }

    public function deleteOpening($storeId, $id)
    {
        return StoreSchedule::where(['store_id' => $storeId, 'id' => $id])->delete();
    }

    public function exitsDay($storeId, $date)
    {
        return StoreSchedule::where('store_id', $storeId)->where('date', $date)->exists();
    }
}
