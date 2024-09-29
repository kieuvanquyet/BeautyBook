{{-- @extends('layouts.backend')
@section('css')
@endsection
@section('content')
<div class="block-header block-header-default">
    <h3 class="block-title">Thông tin chi tiết của bạn</h3>
    <div class="block-options">
        <a href="{{route('admin.stores.index')}}" type="button" class="btn btn-sm btn-alt-secondary">
            <i class="fa fa-fw fa-angle-left"></i> Quay trở về danh sách
        </a>
    </div>
</div>
<div class="col-12">
    <!-- Vertical Block Tabs Default Style With Extra Info -->
    <div class="block block-rounded row g-0">
        <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-4 col-xxl-2" role="tablist">
            <li class="nav-item d-md-flex flex-md-column">
                <button class="nav-link text-md-start active" id="btabs-vertical-info-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-home" role="tab" aria-controls="btabs-vertical-info-home" aria-selected="true">
                    <i class="fa fa-fw fa-database me-1 d-none d-sm-inline-block"></i>
                    <span>Home</span>
                </button>
            </li>
            <li class="nav-item d-md-flex flex-md-column">
                <button class="nav-link text-md-start" id="btabs-vertical-info-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-profile" role="tab" aria-controls="btabs-vertical-info-profile" aria-selected="false">
                    <i class="far fa-fw fa-clock me-1 d-none d-sm-inline-block"></i>
                    <span>Giờ mở cửa</span>
                </button>
            </li>
            <li class="nav-item d-md-flex flex-md-column">
                <button class="nav-link text-md-start" id="btabs-vertical-info-settings-tab" data-bs-toggle="tab" data-bs-target="#btabs-vertical-info-settings" role="tab" aria-controls="btabs-vertical-info-settings" aria-selected="false">
                    <i class="fa fa-fw fa-user-circle me-1 d-none d-sm-inline-block"></i>
                    <span>Nhân viên</span>
                </button>
            </li>
        </ul>
        <div class="tab-content col-md-8 col-xxl-10 pb-5">
            <div class="block-content tab-pane active" id="btabs-vertical-info-home" role="tabpanel" aria-labelledby="btabs-vertical-info-home-tab" tabindex="0">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h4 class="fw-semibold">Chỉnh sửa thông tin cơ bản</h4>
                
                <form action="{{ route('store.update_infor', ['id' => $idStore->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex">
                        <div class="col-lg-8 col-xl-5 me-5">
                        <img src="{{ asset('storage/' . $idStore->image) }}" alt="Hình ảnh cửa hàng" style="width:150px; height:150px;">
                            <div class="mb-4">
                                <label class="form-label" for="image">Hình ảnh</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="name">Tên cửa hàng</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $idStore->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="address">Địa chỉ</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $idStore->address) }}">
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="phone">Số điện thoại</label>
                                <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $idStore->phone) }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="link_map">Vị trí</label>
                                <input type="text" class="form-control @error('link_map') is-invalid @enderror" id="link_map" name="link_map" value="{{ old('link_map', $idStore->link_map) }}">
                                @error('link_map')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    @can('update', $idStore)
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa fa-fw fa-plus"></i> Lưu thay đổi
                    </button>
                    @endcan
                </form>
            </div>
            <div class="block-content tab-pane" id="btabs-vertical-info-profile" role="tabpanel" aria-labelledby="btabs-vertical-info-profile-tab" tabindex="0">
                <h4 class="fw-semibold">Giờ mở cửa</h4>
            </div>
            <div class="block-content tab-pane" id="btabs-vertical-info-settings" role="tabpanel" aria-labelledby="btabs-vertical-info-settings-tab" tabindex="0">
                <h4 class="fw-semibold">Nhân viên</h4>
            </div>
        </div>
    </div>
    <!-- END Vertical Block Tabs Default Style With Extra Info -->
</div>
@endsection
@section('js')
@endsection --}}