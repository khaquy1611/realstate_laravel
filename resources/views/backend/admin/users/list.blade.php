@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Tìm kiếm người dùng
                    </div>
                    <form action="">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Mã STT:</div>
                                    <input type="text" name="id" class="form-control"
                                        placeholder="Nhập mã thứ tự...">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Tên:</div>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Họ tên:</div>
                                    <input type="text" name="username" class="form-control" placeholder="Nhập họ tên...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Email:</div>
                                    <input type="text" name="email" class="form-control" placeholder="Nhập email...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Số điện thoại:</div>
                                    <input type="text" name="phone" class="form-control"
                                        placeholder="Nhập số điện thoại...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Địa chỉ:</div>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Nhập địa chỉ nơi ở...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Website:</div>
                                    <input type="text" name="website" class="form-control"
                                        placeholder="Nhập địa chỉ website...">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Vai trò:</div>
                                    <select name="" class="form-control" id="" name="role">
                                        <option value="">-- Chọn vai trò --</option>
                                        <option value="admin">Admin</option>
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Trạng thái:</div>
                                    <select name="" class="form-control" id="" name="status">
                                        <option value="">-- Chọn trạng thái --</option>
                                        <option value="0">Không kích hoạt</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">

                            <i class="link-icon" data-feather="search"></i>
                            Tìm kiếm
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger refresh">

                            <i class="link-icon" data-feather="refresh-ccw"></i>
                            Tải lại
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách người dùng</h4>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Số điện thoại</th>
                                    <th>Website</th>
                                    <th>Địa chỉ</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($data['getRecord']) && is_object($data['getRecord']))
                                    @foreach ($data['getRecord'] as $key => $val)
                                        <tr class="table-info text-dark text-center">
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->username }}</td>
                                            <td>{{ $val->email }}</td>
                                            <td>
                                                @if (!empty($val->photo))
                                                    <img src="{{ asset('upload/' . $val->photo) }}"
                                                        style="width: 50%; height: 50%; border-radius: 50px; margin: 10px 0;"
                                                        alt="image profiles previews">
                                                @else
                                                    <img src="{{ asset('upload/default.png') }}"
                                                        style="width: 50%; height: 50%; border-radius: 50px; margin: 10px 0;"
                                                        alt="image profiles previews">
                                                @endif
                                            </td>
                                            <td>{{ $val->phone }}</td>
                                            <td>{{ $val->website }}</td>
                                            <td>{{ $val->address }}</td>
                                            <td>
                                                @if ($val->role === 'admin')
                                                    <span class="badge bg-info">admin</span>
                                                @elseif ($val->role == 'agent')
                                                    <span class="badge bg-primary">Agent</span>
                                                @else
                                                    <span class="badge bg-success">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($val->status)
                                                    <span class="badge bg-primary" id="status-{{ $val->id }}">Kích
                                                        hoạt</span>
                                                @else
                                                    <span class="badge bg-danger" id="status-{{ $val->id }}">Không
                                                        kích hoạt</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="toggle-status-btn btn btn-small {{ $val->status ? 'btn-danger' : 'btn-primary' }}"
                                                    data-user-id="{{ $val->id }}">
                                                    {{ $val->status ? 'Ngừng kích hoạt' : 'Kích hoạt' }}
                                                </a>

                                                <a class="dropdown-item d-flex view-details align-items-center btn-success"
                                                    href="{{ route('admin.user.details', $val->id) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-eye icon-sm me-2">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg> <span class="">Xem chi tiết</span></a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($val->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if (empty($data['getRecord']) || $data['getRecord']->count() == 0)
                            <div style="text-align: center; background:#ccc">Dữ liệu trống</div>
                        @endif
                        {{ $data['getRecord']->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
