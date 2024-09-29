@extends('layouts.backend');

@section('css')
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thêm mới nhân viên</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" style="color: inherit;">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới nhân viên</li>
                </ol>
            </nav>
        </div>
    </div>
  </div>
  <!-- END Hero -->
  <div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="content-heading pt-0">Thêm mới nhân viên</h2>

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">
                        <!-- Tên nhân viên -->
                        <div class="mb-4">
                            <label class="form-label" for="name">Tên nhân viên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên nhân viên" >
                            @error('name')
                                <div class="text-danger mt-2" id="name-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" >
                            @error('email')
                                <div class="text-danger mt-2" id="email-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-4">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" >
                            @error('phone')
                                <div class="text-danger mt-2" id="phone-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ảnh đại diện -->
                        <div class="mb-4">
                            <label class="form-label" for="image">Ảnh đại diện</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="text-danger mt-2" id="image-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-4">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nhập mật khẩu" >
                            @error('password')
                                <div class="text-danger mt-2" id="password-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Chọn cửa hàng -->
                        <div class="mb-4">
                            <label class="form-label" for="store_id">Cửa hàng</label>
                            <select class="form-control @error('store_id') is-invalid @enderror" id="store_id" name="store_id" >
                                <option value="" disabled selected>Chọn cửa hàng</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('store_id')
                                <div class="text-danger mt-2" id="store_id-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vai trò -->
                        <div class="mb-4">
                            <label class="form-label" for="role">Vai trò</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" >
                                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Quản lý</option>
                                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                                <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Thu ngân</option>
                            </select>
                            @error('role')
                                <div class="text-danger mt-2" id="role-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-4">
                            <label class="form-label" for="biography">Tiểu sử</label>
                            <textarea class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="4" placeholder="Nhập mô tả">{{ old('biography') }}</textarea>
                            @error('biography')
                                <div class="text-danger mt-2" id="biography-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trạng thái hết hạn -->
                        <div class="mb-4">
                            <label class="form-label" for="expired">Trạng thái</label>
                            <select class="form-control @error('expired') is-invalid @enderror" id="expired" name="expired" >
                                <option value="0" {{ old('expired') == '0' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="1" {{ old('expired') == '1' ? 'selected' : '' }}>Hết hạn</option>
                            </select>
                            @error('expired')
                                <div class="text-danger mt-2" id="expired-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-4">Tạo Nhân Viên</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const fields = ['name', 'email', 'phone', 'image', 'password', 'store_id', 'role', 'biography', 'expired'];

    fields.forEach(function(field) {
        const inputElement = document.getElementById(field);
        const errorElement = document.getElementById(`${field}-error`);

        if (inputElement) {
            inputElement.addEventListener('input', function () {
               
                if (inputElement.classList.contains('is-invalid')) {
                    inputElement.classList.remove('is-invalid');
                }

               
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            });
        }
    });
});
</script>
@endsection