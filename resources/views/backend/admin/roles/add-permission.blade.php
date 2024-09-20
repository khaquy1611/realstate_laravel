@extends('backend.admin.layout')
@section('admin')
    {!! generateBreadcrumbs($breadcrumbs) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                <div class="card-header">
                    <h4>
                        Vai trò : {{ $role->name }}
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary float-end">
                            <i class="link-icon" data-feather="arrow-left"></i>
                            Quay trở lại
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role.permissions', $role->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Tên các quyền:</label>

                        </div>
                        <div class="row">
                            @foreach ($permissions as $key => $permission)
                                <div class="col-md-2">
                                    <label for="">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $roles_has_permissions) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>


                        <div class="mb-3 mt-3">
                            <button type="submit" class="btn btn-primary me-2">Cấp Quyền</button>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                                <i class="link-icon" data-feather="arrow-left"></i>
                                Quay trở lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
