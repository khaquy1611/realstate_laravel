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
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
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
                                                <label for="login" class="form-label">Email/Name/Phone:</label>
                                                <input type="text" class="form-control" id="login" name="login"
                                                    placeholder="Please enter your email/name/phone..."
                                                    value="{{ old('login') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password:</label>
                                                <input type="password" class="form-control" id="password"
                                                    autocomplete="current-password"
                                                    placeholder="Please enter your password..."
                                                    value="{{ old('password') }}" name="password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="captcha">Captcha Code:</label>
                                                <input type="text" class="form-control" id="captcha"
                                                    placeholder="Please enter your captcha code..."
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
                                                    Remember me
                                                </label>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">

                                                    Login
                                                </button>
                                            </div>
                                            <a href="" class="d-block mt-3 text-muted">Not a user? Sign
                                                up</a>
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
