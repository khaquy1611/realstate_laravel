@extends('backend.admin.layout')
@section('admin')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">Cấp vai trò cho user: {{ $user->name }}</div>
            <form action="" method="" class="p-2">
                @if (isset($roles))
                    @foreach ($roles as $key => $role)
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" type="radio" name="role" id="{{ $role->id }}"
                                value="{{ $role->name }}" {{ Auth::user()->hasRole($role->name) ? 'checked' : '' }}>
                            <label class="form-check-label" id="{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success m-2 p-2 " name="insertRole">Cấp vai trò</button>
                @endif
            </form>
        </div>
    </div>
@endsection
