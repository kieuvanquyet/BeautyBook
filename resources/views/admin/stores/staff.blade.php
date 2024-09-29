@extends('layouts.backend')

@section('css')
<style>
    img {
        width: 3.125rem;
        height: 3.125rem;
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Danh sách nhân viên</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if(isset($staffs[0]))
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.stores.edit', $staffs[0]->store_id)}}" style="color: inherit;">Cửa
                                hàng</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Danh sách nhân viên</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Danh sách nhân viên</h3>
        </div>
        <div class="block-content">
            @if ($staffs->count() > 0)
                <table class="table table-hover" id="usersTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th></th>
                            <th>Tên</th>
                            <th class="d-none d-sm-table-cell">Vai trò</th>
                            <th class="d-none d-sm-table-cell">Số điện thoại</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="d-none d-sm-table-cell">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $item)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><img class="img object-fit-fill rounded-3" src="{{ \Storage::url($item->image) }}" alt="">
                                </td>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ ucfirst($item->role) }}</td>
                                <td class="d-none d-sm-table-cell">{{ $item->phone }}</td>
                                <td class="d-none d-sm-table-cell">{{ $item->email }}</td>
                                <td class="d-none d-sm-table-cell">{{ $item->created_at->format('H:i d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex align-items-center justify-content-center p-5">
                    <p class="m-0 p-5">Không tìm thấy nhân viên</p>
                </div>
            @endif
            <div class="block-options mb-5">
                <a href="{{route('admin.stores.index')}}" class="btn btn-alt-secondary">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection