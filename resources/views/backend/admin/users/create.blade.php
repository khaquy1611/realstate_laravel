@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Thêm mới người dùng</h6>

                <form class="forms-sample">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Tên: <span style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Vui lòng nhập tên..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Họ Tên: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Vui lòng nhập họ tên..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Vui lòng nhập email..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Mật khẩu:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Vui lòng nhập mật khẩu...">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-3 col-form-label">Địa chỉ: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Vui lòng nhập địa chỉ..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Số điện thoại: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Vui lòng nhập số điện thoại..." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Vai trò: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" required>
                                <option value="">-- Chọn vai trò --</option>
                                <option value="admin">Admin
                                </option>
                                <option value="agent">Agent
                                </option>
                                <option value="user">User
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ route('admin.users.index')}}" class="btn btn-secondary">
                        <i class="link-icon" data-feather="arrow-left"></i>
                        Quay trở lại
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
