@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-item-center">
                        <h4 class="card-title">Danh sách vai trò</h4>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
                                <i class="link-icon" data-feather="plus"></i>
                                Thêm mới vai trò người dùng
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên vai trò</th>
                                    <th>Hành động</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($roles) && is_object($roles))
                                    @foreach ($roles as $key => $role)
                                        <tr class="table-info text-dark text-center">
                                            <td>{{ $role->id }}</td>
                                            <td>
                                                @if ($role->name == 'admin')
                                                    <span class="badge bg-info">admin</span>
                                                @elseif ($role->name == 'agent')
                                                    <span class="badge bg-primary">Agent</span>
                                                @elseif ($role->name == 'user')
                                                    <span class="badge bg-success">User</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $role->name }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.role.edit', $role->id) }}"
                                                    class="btn btn-primary rounded-md">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                    Chỉnh sửa
                                                </a>
                                                <a href="{{ route('admin.role.delete', $role->id) }}"
                                                    class="btn btn-danger rounded-md">
                                                    <i class="link-icon" data-feather="trash"></i>
                                                    Xóa
                                                </a>
                                                <a href="{{ route('admin.role.permissions', $role->id) }}"
                                                    class="btn btn-warning">
                                                    <i class="link-icon" data-feather="key"></i>
                                                    Gán quyền cho vai trò
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($role->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if (empty($roles) || $roles->count() == 0)
                            <div style="text-align: center; background:#ccc">Dữ liệu trống</div>
                        @endif
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
