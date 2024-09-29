@extends('layouts.backend')

@section('content')
    <div class="container mt-3">
        <div class="block-header block-header-default">
            <h3 class="block-title">Danh sách nhân viên</h3>
            <div class="block-options">
                <a class="btn btn-sm btn-alt-secondary" href="{{route('admin.stores.edit',$staffs[0]->store_id)}}">
                    <i class="fa fa-fw fa-angle-left"></i> Quay lại
                </a>
            </div>
        </div>

        <div class="block block-rounded row g-0">
            <div class="col">
                @if ($staffs->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tên nhân viên</th>
                                <th>Vai trò</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Thời gian tạo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr class="align-middle">
                                    <td><img class="img object-fit-fill rounded-3" width="" src="{{ \Storage::url($staff->image) }}" alt=""></td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->role }}</td>
                                    <td>{{ $staff->phone }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $item->created_at->format('H:i d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="d-flex align-items-center justify-content-center p-5">
                        <p class="m-0 p-5">Cửa hàng hiện chưa có nhân viên nào</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        img {
        width: 3.125rem;
        height: 3.125rem;
    }
    </style>
@endsection
