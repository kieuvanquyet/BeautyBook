@extends('layouts.backend')

@section('css')
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Cập nhật cửa hàng</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.stores.index') }}" style="color: inherit;">Stores</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cập nhật cửa hàng</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <form action="{{ route('admin.stores.update', $store) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-between content-heading pt-0">
                    <h2 class="content-heading pt-0 border-0">Cập nhật cửa hàng</h2>
                    <div>
                        <a class="btn btn-info" href="{{route('admin.opening-store', $store->id)}}">Giờ mở cửa</a>
                        <a class="btn btn-info" href="{{route('admin.store.staffs', $store)}}">Nhân viên</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-xl-8 offset-xl-2">
                        <!-- Tên cửa hàng -->
                        <div class="mb-4">
                            <label class="form-label" for="name">Tên cửa hàng</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $store->name) }}" placeholder="Nhập tên cửa hàng">
                            @error('name')
                                <div class="text-danger mt-2" id="name-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-4">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address', $store->address) }}"
                                placeholder="Nhập địa chỉ cửa hàng">
                            @error('address')
                                <div class="text-danger mt-2" id="address-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Địa chỉ bản đồ -->
                        <div class="mb-4">
                            <label class="form-label" for="link_map">Đường dẫn bản đồ</label>
                            <input type="url" class="form-control @error('link_map') is-invalid @enderror" id="link_map"
                                name="link_map" value="{{ old('link_map', $store->link_map) }}"
                                placeholder="Nhập đường dẫn Google Maps">
                            @error('link_map')
                                <div class="text-danger mt-2" id="link_map-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-4">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $store->phone) }}"
                                placeholder="Nhập số điện thoại cửa hàng">
                            @error('phone')
                                <div class="text-danger mt-2" id="phone-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ảnh đại diện -->
                        <div class="mb-4">
                            <label class="form-label" for="image">Ảnh đại diện</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            @if($store->image)
                                <img src="{{ Storage::url($store->image) }}" width="100" height="50"
                                    alt="Ảnh đại diện hiện tại" class="mt-2">
                            @endif
                            @error('image')
                                <div class="text-danger mt-2" id="image-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-4">
                            <label class="form-label" for="description">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="4"
                                placeholder="Nhập mô tả cửa hàng">{{ old('description', $store->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-2" id="description-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="block-options mb-5">
                            <button type="submit" class="btn btn-primary me-2">Cập nhật cửa hàng</button>
                            <a href="{{route('admin.stores.index')}}" class="btn btn-alt-secondary">
                                <i class="fa fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
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
        const fields = ['name', 'address', 'link_map', 'phone', 'image', 'description'];

        fields.forEach(function (field) {
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