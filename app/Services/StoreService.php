<?php

namespace App\Services;

use App\Models\Store;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreService
{
    use ImageUploadTrait;

    /**
     * Tạo một cửa hàng mới.
     */
    public function createStore(array $data, $file = null)
    {
        if ($file) {
            // Sử dụng phương thức handleImage từ Trait để xử lý upload ảnh
            $data['image'] = $this->uploadFile($file, 'image_stores');
        }

        return Store::query()->create($data);
    }

    /**
     * Cập nhật thông tin của một cửa hàng.
     */
    public function updateStores(Store $store, array $data, $file = null)
    {
        // Nếu có ảnh mới
        if ($file) {
            // Sử dụng phương thức handleImage từ Trait để xử lý upload và xóa ảnh cũ
            $data['image'] = $this->handleImage($file, $store->image, 'image_stores');
        }

        // Cập nhật thông tin của cửa hàng
        $store->update($data);

    }

    public function loadIdStore($id)
    {
        return Store::query()->find($id);
    }

    public function updateStore($params, $id)
    {
        $store = Store::query()->find($id);
        if (! $store) {
            return ['error' => 'Store not found'];
        }
        $store->update($params);

        return $store;
    }

    /**
     * Xóa một cửa hàng khỏi hệ thống.
     */
    public function deleteStore(Store $store)
    {
        // Xóa ảnh khi xóa cửa hàng
        $imagePath = $store->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        // Xóa cửa hàng
        $store->delete();
    }

    // Lấy nhân viên theo cửa hàng
    public function getStoreStaff($store)
    {
        return $store->staffs()->get();

    }
}
