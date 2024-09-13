<!DOCTYPE html>

<html lang="en">

<head>
    @include('backend.admin.dashboard.components.head')
</head>
<div class="container">
    <h2>Kích hoạt 2FA</h2>
    <p>Quét mã QR bên dưới bằng ứng dụng Google Authenticator:</p>
    <div class="qr-code-container">{!! $qrCode !!}</div>

    <form method="POST" action="{{ route('enable.2fa') }}">
        @csrf
        <button type="submit" style="margin: 20px 0;" class="btn btn-primary">Kích hoạt 2FA</button>
    </form>
</div>
@include('backend.admin.dashboard.components.script')

</body>

</html>
