<!DOCTYPE html>

<html lang="en">

<head>
    @include('backend.admin.dashboard.components.head')
</head>

<body>

    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">

                                    <img src="{{ asset('upload/login.png') }}" alt="logo login"
                                        style="width: 100%; height: 100%;">

                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#"
                                            class="noble-ui-logo logo-light d-block mb-2">ESC<span>UI</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Chào Mừng! Thay đổi mật khẩu.
                                        </h5>
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
                                        <form class="forms-sample" method="POST"
                                            action="{{ route('set_new_password', $token) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mật khẩu mới:</label>
                                                <input type="password" class="form-control" id="password"
                                                    autocomplete="current-password"
                                                    placeholder="Vui lòng nhập mật khẩu mới của người dùng..."
                                                    value="{{ old('password') }}" name="password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="passwordConfirm" class="form-label">Xác nhận mật
                                                    khẩu:</label>
                                                <input type="password" class="form-control" id="passwordConfirm"
                                                    autocomplete="current-password"
                                                    placeholder="Vui lòng nhập lại mật khẩu để xác nhận..."
                                                    value="{{ old('passwordConfirm') }}" name="passwordConfirm">
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">

                                                    Thay đổi mật khẩu
                                                </button>
                                            </div>
                                    </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    @include('backend.admin.dashboard.components.script')

</body>

</html>
