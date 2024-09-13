<!DOCTYPE html>

<html lang="en">

<head>
    @include('backend.admin.dashboard.components.head')
</head>
<div class="container">
    <h2 style="margin: 20px 0;">Xác thực 2FA</h2>
    @include('backend.admin._message')
    <form method="POST" action="{{ route('2fa.verify.post') }}">
        @csrf
        <div class="form-group" style="margin: 20px 0;">
            <label style="margin-bottom: 10px;" for="2fa_code">Nhập mã 2FA:</label>
            <input type="text" name="2fa_code" class="form-control" required>
        </div>
        <button  type="submit" class="btn btn-primary">Xác thực</button>
    </form>
</div>
@include('backend.admin.dashboard.components.script')

</body>

</html>
