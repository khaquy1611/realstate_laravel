@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="d-flex align-items-center total">
        <a href="javascript:void(0)" class="btn btn-info">
            <span class="totals">{{ $data['totalAdmin'] }}</span> Admin
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-info">
            <span class="totals">{{ $data['totalSuperAdmin'] }}</span> Super Admin
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-warning">
            <span class="totals">{{ $data['totalAgent'] }}</span> Agent
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-secondary">
            <span class="totals">{{ $data['totalUser'] }}</span> User
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-primary">
            <span class="totals">{{ $data['totalActive'] }}</span> Kích hoạt
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-danger">
            <span class="totals">{{ $data['totalInActive'] }}</span> Không kích hoạt
        </a>&nbsp;&nbsp;
        <a href="javascript:void(0)" class="btn btn-success">
            <span class="totals">{{ $data['total'] }}</span> Tổng
        </a>
    </div>
    <div class="row mt-4 mb-4">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                @include('backend.admin._message')
                @if (session()->has('impersonate'))
                    <div class="alert alert-warning">
                        Bạn đang impersonate người dùng khác. <a href="{{ route('admin.stop.impersonate') }}">Thoát khỏi chế
                            độ
                            impersonate</a>.
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-title">
                        Tìm kiếm người dùng
                    </div>
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Mã STT:</div>
                                    <input type="text" name="id" userue="{{ Request()->id }}" class="form-control"
                                        placeholder="Nhập mã thứ tự...">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Tên:</div>
                                    <input type="text" name="name" userue="{{ Request()->name }}"
                                        class="form-control" placeholder="Nhập tên...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Họ tên:</div>
                                    <input type="text" name="username" userue="{{ Request()->username }}"
                                        class="form-control" placeholder="Nhập họ tên...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Email:</div>
                                    <input type="text" name="email" userue="{{ Request()->email }}"
                                        class="form-control" placeholder="Nhập email...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Số điện thoại:</div>
                                    <input type="text" name="phone" userue="{{ Request()->phone }}"
                                        class="form-control" placeholder="Nhập số điện thoại...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Địa chỉ:</div>
                                    <input type="text" name="address" userue="{{ Request()->address }}"
                                        class="form-control" placeholder="Nhập địa chỉ nơi ở...">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Website:</div>
                                    <input type="text" name="website" userue="{{ Request()->website }}"
                                        class="form-control" placeholder="Nhập địa chỉ website...">
                                </div>
                            </div>



                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Vai trò:</div>
                                    <select class="form-control" name="role">
                                        <option userue="">-- Chọn vai trò --</option>
                                        <option userue="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option userue="agent" {{ request('role') == 'agent' ? 'selected' : '' }}>Agent
                                        </option>
                                        <option userue="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Trạng thái:</div>
                                    <select class="form-control" name="status">
                                        <option userue="">-- Chọn Trạng Thái --</option>
                                        <option userue="1" {{ request('status') == '1' ? 'selected' : '' }}>Kích hoạt
                                        </option>
                                        <option userue="0" {{ request('status') == '0' ? 'selected' : '' }}>Không kích
                                            hoạt
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Ngày bắt đầu:</div>
                                    <input type="date" name="start_date" userue="{{ Request()->start_date }}"
                                        class="form-control" placeholder="Tìm kiếm theo ngày bắt đầu...">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <div class="form-label">Ngày kết thúc:</div>
                                    <input type="date" name="end_date" userue="{{ Request()->end_date }}"
                                        class="form-control" placeholder="Tìm kiếm theo ngày kết thúc...">
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
                    <div class="d-flex justify-content-between align-item-center">
                        <h4 class="card-title">Danh sách người dùng</h4>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="link-icon" data-feather="plus"></i>
                                Thêm mới người dùng
                            </a>
                        </div>
                    </div>
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
                                    <th>Các quyền đã cấp</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($data['getRecord']) && is_object($data['getRecord']))
                                    @foreach ($data['getRecord'] as $key => $user)
                                        <tr class="table-info text-dark text-center">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (!empty($user->photo))
                                                    <img src="{{ asset('upload/' . $user->photo) }}"
                                                        style="width: 50%; height: 50%; border-radius: 50px; margin: 10px 0;"
                                                        alt="image profiles previews">
                                                @else
                                                    <img src="{{ asset('upload/default.png') }}"
                                                        style="width: 50%; height: 50%; border-radius: 50px; margin: 10px 0;"
                                                        alt="image profiles previews">
                                                @endif
                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->website }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $rolename)
                                                        <span class="badge bg-info mx-1">{{ $rolename }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($user->getPermissionsViaRoles()))
                                                    @foreach ($user->getPermissionsViaRoles() as $key => $permission)
                                                        <span class="badge bg-danger mx-1">{{ $permission->name }}</span>
                                                    @endforeach
                                                @endif

                                            </td>
                                            <td>
                                                @if ($user->status)
                                                    <span class="badge bg-primary" id="status-{{ $user->id }}">Kích
                                                        Hoạt</span>
                                                @else
                                                    <span class="badge bg-danger" id="status-{{ $user->id }}">Không
                                                        kích hoạt</span>
                                                @endif
                                            </td>
                                            <td class="action">
                                                <a class="toggle-status-btn btn btn-small {{ $user->status ? 'btn-danger' : 'btn-primary' }}"
                                                    data-user-id="{{ $user->id }}">
                                                    {{ $user->status ? 'Ngừng kích hoạt' : 'Kích hoạt' }}
                                                </a>
                                                @can('details users')
                                                    <a class="dropdown-item d-flex view-details align-items-center btn-success"
                                                        href="{{ route('admin.user.details', $user->id) }}"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-eye icon-sm me-2">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg> <span class="">Xem chi tiết</span></a>
                                                @endcan
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                    Sửa người dùng
                                                </a>

                                                <a href="{{ route('admin.users.delete', $user->id) }}"
                                                    class="btn btn-danger">
                                                    <i class="link-icon" data-feather="trash"></i>
                                                    Xóa người dùng
                                                </a>

                                                <a href="{{ route('admin.users.impersonate', $user->id) }}"
                                                    class="btn btn-info" style="color: #fff">
                                                    <i class="link-icon" data-feather="corner-down-left"></i>
                                                    Chuyển quyền nhanh
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
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
