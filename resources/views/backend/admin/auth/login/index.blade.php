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
                                        <h5 class="text-muted fw-normal mb-4">Chào Mừng! Đăng nhập vào tài khoản của bạn.</h5>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Vui lòng nhập Email..."
                                                    value="{{ old('email') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mật Khẩu:</label>
                                                <input type="password" class="form-control" id="password"
                                                    autocomplete="current-password"
                                                    placeholder="Vui lòng nhập mật khẩu của bạn..."
                                                    value="{{ old('password') }}" name="password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="captcha">Mã Captcha:</label>
                                                <input type="text" class="form-control" id="captcha"
                                                    placeholder="Vui lòng nhập mã captcha..."
                                                    value="{{ old('captcha') }}" name="captcha">
                                                <br>
                                                <span id="captcha-img">
                                                    {!! Captcha::img('math') !!}
                                                </span>

                                                <span class="refresh-captcha">
                                                    <a href="#">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                </span>

                                            </div>

                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="authCheck">
                                                <label class="form-check-label" for="authCheck">
                                                    Ghi nhớ tài khoản
                                                </label>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">

                                                    Đăng Nhập
                                                </button>
                                            </div>
                                            <a href="{{ route('register')}}" class="d-block mt-3 text-muted">Chưa có tài khoản ? Đăng Ký</a>
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
