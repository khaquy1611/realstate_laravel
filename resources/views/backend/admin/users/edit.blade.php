@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('backend.admin._message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h6 class="card-title">Chỉnh sửa người dùng</h6>

                <form class="forms-sample" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Tên: <span style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $user->name }}" placeholder="Vui lòng nhập tên..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Họ Tên: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Vui lòng nhập họ tên..." required value="{{ $user->username }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Vui lòng nhập email..." required value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Mật Khẩu: </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Vui lòng nhập mật khẩu..." value="">
                            <div style="color:#fff" class="mt-2">( Nếu ko
                                nhập mật khẩu mặc để trống )</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-3 col-form-label">Địa chỉ: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Vui lòng nhập địa chỉ..." required value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Số điện thoại: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Vui lòng nhập số điện thoại..." required value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Vai trò: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" multiple name="roles[]" required>
                                <option value="">-- Chọn vai trò --</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                        {{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Trạng thái: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                                <option value="">-- Chọn trạng thái --</option>
                                <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Kích hoạt
                                </option>
                                <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Không kích hoạt
                                </option>

                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Cập nhập</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="link-icon" data-feather="arrow-left"></i>
                        Quay trở lại
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
