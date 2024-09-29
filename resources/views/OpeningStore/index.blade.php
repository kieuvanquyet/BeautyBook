@extends('layouts.backend')
@section('content')
    <base href="/">


    <main id="main-container">




        <!-- Hero -->
        <div class="bg-image" style="background-image: url('assets/media/photos/photo13@2x.jpg');">
            <div class="bg-black-50">
                <div class="content content-full">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="flex-grow-1 fs-2 text-white my-2">
                            <i class="fa fa-boxes text-white-50 me-1"></i> Detail Open Store
                        </h1>
                        <a class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modal-block-large"">
                            <i class="fa fa-fw fa-plus opacity-50"></i>
                            <span class="d-none d-sm-inline ms-1">New Open Store</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>



        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
            <form action="be_pages_projects_dashboard.html" method="POST" onsubmit="return false;">
                <div class="row items-push">
                    <div class="col-sm-6 col-xl-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="dm-projects-search"
                                name="dm-projects-search" placeholder="Search Projects..">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 offset-xl-6">
                        <select class="form-select" id="dm-projects-filter" name="dm-projects-filter">
                            <option value="all">All (6)</option>
                            <option value="active">Active (3)</option>
                            <option value="pending">Pending (1)</option>
                            <option value="planning">Planning (1)</option>
                            <option value="canceled">Canceled (1)</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="row items-push">
                @foreach ($getOpeningStore as $item)
                    <div class="col-md-6 col-xl-4">
                        <!-- Project #1 -->
                        <div class="block block-rounded h-100 mb-0">
                            <div class="block-header">
                                <div class="flex-grow-1 text-muted fs-sm fw-semibold">
                                    <i class="fa fa-calendar-check me-1"></i>
                                    {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d-m-Y') : 'N/A' }}<br>
                                    <i class="fa fa-clock me-1"></i> {{ $item->opening_time }} - {{ $item->closing_time }}
                                </div>

                                <div class="block-options">
                                    <div class="dropdown">
                                        <button type="button" class="btn-block-option" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <form
                                                action="{{ route('admin.delete-opening-store', [$item->store_id, $item->id]) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Are you sure?')" type="submit" class="dropdown-item" href="javascript:void(0)">
                                                    <i class="fa fa-fw fa-bell me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content bg-body-light text-center">
                                <h3 class="fs-4 fw-bold mb-1">
                                    <a href="be_pages_projects_tasks.html">Opening Store </a>
                                </h3>
                                <h4 class="fs-6 text-muted mb-3"><strong>Opening time:</strong> {{ $item->opening_time }}
                                </h4>
                                <h4 class="fs-6 text-muted mb-3"><strong>Closing time:</strong> {{ $item->closing_time }}
                                </h4>
                                {{-- <div class="push">
                                    <span class="badge bg-success text-uppercase fw-bold py-2 px-3">Active</span>
                                </div> --}}
                            </div>
                            {{-- <div class="block-content text-center">
                                <a class="img-link m-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar2.jpg"
                                        alt="">
                                </a>
                                <a class="img-link m-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg"
                                        alt="">
                                </a>
                                <a class="img-link m-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar9.jpg"
                                        alt="">
                                </a>
                                <a class="img-link m-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar10.jpg"
                                        alt="">
                                </a>
                            </div> --}}

                            <div class="block-content block-content-full">
                                <div class="row g-sm">
                                    <div class="col-6">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#modal-block-large-show-opening-store{{ $item->id }}"
                                            class="btn w-100 btn-alt-secondary">
                                            <i class="fa fa-eye me-1 opacity-50"></i> View
                                        </button>
                                    </div>

                                    @if (\Carbon\Carbon::parse($item->date)->gte(\Carbon\Carbon::today()))
                                        <div class="col-6">
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#modal-block-large-update-opening-store{{ $item->id }}"
                                                class="btn w-100 btn-alt-secondary">
                                                <i class="fa fa-archive me-1 opacity-50"></i> Update
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <button title="Cannot update past dates" type="button" class="js-notify btn w-100 btn-alt-secondary push">
                                                <i class="fa fa-archive me-1 opacity-50"></i> Update
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- END Project #1 -->
                    </div>
                    <div class="modal" id="modal-block-large" tabindex="-1" role="dialog"
                        aria-labelledby="modal-block-large" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Modal Title</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.add-opening-store', $item->store_id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="store_id" value="{{ $item->store_id }}">
                                        <div class="block-content mb-3">
                                            <div class="form-group">
                                                <label for="date" class="mb-2">Date</label>
                                                <input type="date" class="form-control" name="date"
                                                    id="date">
                                                @error('date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="opening_time" class="mb-2">Date</label>
                                                <input type="time" class="form-control" name="opening_time"
                                                    id="opening_time">
                                                @error('opening_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="closing_time" class="mb-2">Date</label>
                                                <input type="time" class="form-control" name="closing_time"
                                                    id="closing_time">
                                                @error('closing_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full text-end bg-body">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-alt-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                @foreach ($getOpeningStore as $item)
                    <div class="modal" id="modal-block-large-show-opening-store{{ $item->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Modal Title</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <form action="" method="post">
                                        <div class="block-content mb-3">
                                            <div class="form-group">
                                                <label for="date" class="mb-2">Date</label>
                                                <input type="date" class="form-control" disabled name="date"
                                                    id="date" value="{{ $item->date }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="opening_time" class="mb-2">Open time</label>
                                                <input type="time" class="form-control" disabled name="opening_time"
                                                    id="opening_time" value="{{ $item->opening_time }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="closing_time" class="mb-2">Close time</label>
                                                <input type="time" class="form-control" disabled name="closing_time"
                                                    id="closing_time" value="{{ $item->closing_time }}">
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full text-end bg-body">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="modal-block-large-update-opening-store{{ $item->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">Modal Title{{ $item->id }}</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.update-opening-store', [$item->store_id, $item->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="block-content mb-3">
                                            <div class="form-group " hidden>
                                                <label for="date" class="mb-2">Date</label>
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ $item->date }}" id="date">
                                            </div>
                                            <div class="form-group">
                                                <label for="opening_time" class="mb-2">Opening time</label>
                                                <input type="time" class="form-control" name="opening_time"
                                                    value="{{ \Carbon\Carbon::parse($item->opening_time)->format('H:i') }}"
                                                    id="opening_time">
                                            </div>
                                            <div class="form-group">
                                                <label for="closing_time" class="mb-2">losing time</label>
                                                <input type="time" class="form-control" name="closing_time"
                                                    value="{{ \Carbon\Carbon::parse($item->closing_time)->format('H:i') }}"
                                                    id="closing_time">
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full text-end bg-body">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-bs-dismiss="modal">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="block-options mb-5 ms-6">
            <a href="{{route('admin.stores.index')}}" class="btn btn-alt-secondary">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <!-- END Page Content -->
    </main>
@endsection
