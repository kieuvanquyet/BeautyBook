<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Store;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getListUser($request);

        return view(self::PATH_VIEW.__FUNCTION__, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();

        return view(self::PATH_VIEW.__FUNCTION__, compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Lấy dữ liệu từ request và tạo người dùng mới
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $stores = $this->userService->getStors();
        $user = $this->userService->getUserById($user->id);

        return view(self::PATH_VIEW.__FUNCTION__, compact('user', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        try {
            $this->userService->updateUser($user->id, $request->validated());

            return redirect()->route('admin.users.index')->with('success', 'Cập nhật nhân viên thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());

            return back()->with('error', 'Cập nhật nhân viên không thành công. Vui lòng kiểm tra lại thông tin !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $this->userService->deleteUser($user);

            return back()->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Đã xảy ra lỗi trong quá trình xóa');
        }
    }
}
