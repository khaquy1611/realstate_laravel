@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-item-center">
                        <h4 class="card-title">Danh sách quyền của người dùng</h4>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('admin.permission.create') }}" class="btn btn-primary">
                                <i class="link-icon" data-feather="plus"></i>
                                Thêm mới quyền người dùng
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên quyền</th>
                                    <th>Hành động</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($permissions) && is_object($permissions))
                                    @foreach ($permissions as $key => $permission)
                                        <tr class="table-info text-dark text-center">
                                            <td>{{ $permission->id }}</td>
                                            <td>
                                                {{ $permission->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                    Chỉnh sửa
                                                </a>
                                                <a href="{{ route('admin.permission.delete', $permission->id) }}"
                                                    class="btn btn-danger">
                                                    <i class="link-icon" data-feather="trash"></i>
                                                    Xóa
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($permission->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if (empty($permissions) || $permissions->count() == 0)
                            <div style="text-align: center; background:#ccc">Dữ liệu trống</div>
                        @endif
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
