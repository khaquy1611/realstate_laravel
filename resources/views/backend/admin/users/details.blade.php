@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Xem chi tiết thông tin người dùng</h6>

                <form class="forms-sample">
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Id:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->id }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tên:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Họ Tên:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->username }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->email }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Số điện thoại:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Ảnh đại diện:</label>

                        @if (!empty($data['getRecord']->photo))
                            <img src="{{ asset('upload/' . $data['getRecord']->photo) }}"
                                style="width: 10%; height: 10%; border-radius: 50%;" alt="image profiles previews">
                        @else
                            <img src="{{ asset('upload/default.png') }}"
                                style="width: 10%; height: 10%; border-radius: 50%; " alt="image profiles previews">
                        @endif

                    </div>

                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Địa chỉ:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->address }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">About:</label>
                        <div class="col-sm-9">
                            {{ $data['getRecord']->about }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Vai trò:</label>
                        <div class="col-sm-9">
                            @if ($data['getRecord']->role === 'admin')
                                <span class="badge bg-info">admin</span>
                            @elseif ($data['getRecord']->role == 'agent')
                                <span class="badge bg-primary">Agent</span>
                            @else
                                <span class="badge bg-success">User</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Trạng thái:</label>
                        <div class="col-sm-9">
                            @if ($data['getRecord']->status)
                                <span class="badge bg-primary" id="status-{{ $data['getRecord']->id }}">Kích
                                    hoạt</span>
                            @else
                                <span class="badge bg-danger" id="status-{{ $data['getRecord']->id }}">Không
                                    kích hoạt</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Ngày tạo:</label>
                        <div class="col-sm-9">
                            {{ date('d-m-Y', strtotime($data['getRecord']->created_at)) }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Ngày cập nhập:</label>
                        <div class="col-sm-9">
                            {{ date('d-m-Y', strtotime($data['getRecord']->updated_at)) }}
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary me-2">Quay lại</a>

                </form>

            </div>
        </div>
    </div>
@endsection
