@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
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
                                                <button
                                                    class="toggle-status-btn btn {{ $val->status ? 'btn-danger' : 'btn-primary' }}"
                                                    data-user-id="{{ $val->id }}">
                                                    {{ $val->status ? 'Ngừng kích hoạt' : 'Kích hoạt' }}
                                                </button>
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
