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
                <h6 class="card-title">Thêm mới quyền người dùng</h6>

                <form class="forms-sample" action="{{ route('admin.permission.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Tên Quyền: <span
                                style="color:red">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Vui lòng nhập tên quyền..." required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Lưu</button>
                    <a href="{{ route('admin.permission.index') }}" class="btn btn-secondary">
                        <i class="link-icon" data-feather="arrow-left"></i>
                        Quay trở lại
                    </a>
                </form>

            </div>
        </div>
    </div>
@endsection
