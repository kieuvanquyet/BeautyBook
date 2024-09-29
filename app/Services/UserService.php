<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\StaffSchedule;
use App\Models\Store;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use ImageUploadTrait;

    /**
     * Create a new user with image handling.
     */
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        if (isset($data['image'])) {
            $data['image'] = $this->uploadFile($data['image'], 'image_users');
        }

        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getStors()
    {
        return Store::all();
    }

    public function updateUser($id, array $request)
    {
        $user = $this->getUserById($id);

        if (isset($request['image'])) {
            $request['image'] = $this->handleImage(
                $request['image'],
                $user->image,
                'image_users'
            );
        }

        return $user->update($request);
    }

    public function getListUser(Request $request)
    {
        $query = User::query()
            ->with('store')
            ->select('id', 'store_id', 'name', 'image', 'role', 'phone', 'created_at');

        // Lọc theo tên
        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }

        // Lọc theo vai trò
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        // Phân trang
        $users = $query->paginate(10)->appends($request->except('page'));

        return $users;
    }

    public function deleteUser(User $user)
    {
        // Xóa ảnh khi xóa nhân viên
        $imagePath = $user->image;
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        //Xóa lịch làm việc của nhân viên
        StaffSchedule::query()->where('user_id', $user->id)->delete();

        //Xóa notification của user
        Notification::query()->where('user_id', $user->id)->delete();

        // Xóa nhân viên
        return $user->delete();
    }

    public function getUserById($id)
    {
        return User::with('store')->find($id);
    }

    public function getStores()
    {
        return Store::all();
    }

    public function updateUser($id, array $request)
    {
        $user = $this->getUserById($id);

        if (isset($request['image'])) {
            $request['image'] = $this->handleImage(
                $request['image'],
                $user->image,
                'image_users'
            );
        }

        return $user->update($request);
    }
}
