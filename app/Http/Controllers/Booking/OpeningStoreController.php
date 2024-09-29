<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpeningStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class OpeningStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($storeId)
    {
        $getOpeningStore = $this->openingService->getOpeningStore($storeId);
        $storeId = $this->openingService->findStoreId($storeId);

        return view('OpeningStore.index', compact(['getOpeningStore', 'storeId']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($storeId)
    {
        return view('OpeningStore.index', compact('storeId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($storeId, OpeningStoreRequest $request)
    {
        try {
            if ($this->openingService->exitsDay($storeId, $request->date)) {
                return redirect()->back()->with('error', 'Ngày đã tồn tại . Vui lòng cập nhật lại !');
            } else {
                $this->openingService->createOpening($storeId, $request->validated());

                return redirect()->back()->with('success', 'Thêm mới giờ mở cửa thành công ');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Thêm mới giờ mở cửa thất bại. Vui lòng kiểm tra lại dữ liệu !');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $storeId)
    {
        $storeId = $this->openingService->findStoreId($storeId);

        return view('OpeningStore.index', compact('storeId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($storeId, string $id, OpeningStoreRequest $request)
    {
        $this->openingService->updateOpening($id, $storeId, $request);

        return redirect()->back()->with('success', 'Cập nhật giờ mở cửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($storeId, string $id, Request $request)
    {
        try {
            $this->openingService->deleteOpening($storeId, $id);

            return redirect()->back()->with('success', 'Xoá giờ mở cửa thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
