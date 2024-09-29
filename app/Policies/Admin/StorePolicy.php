<?php

namespace App\Policies\Admin;

use App\Models\Admin\Store;
use App\Models\User;

class StorePolicy
{
    public function edit(User $user, Store $store)
    {
        // Nếu user là manager, cho phép thực hiện mà không cần kiểm tra store_id
        if (in_array($user->role, ['manager'])) {
            return true;
        }

        // Kiểm tra quyền truy cập cho các vai trò khác
        return $user->store_id === $store->id;
    }

    public function update(User $user, Store $store): bool
    {
        // Giả sử chỉ có manager có quyền cập nhật
        if (in_array($user->role, ['manager'])) {
            return true;
        }

        // Những vai trò khác không được phép cập nhật
        return false;
    }
}
