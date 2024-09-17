<x-mail::message>
    Hi , {{ $user->username }} . Vui lòng đặt mật khẩu tài khoản mới
    <p>Nhấp vào đường link bên dưới...</p>
    @component('mail::button', ['url' => url('set_new_password/' . $user->remember_token)])
        Thiết lập mật khẩu của bạn
        ;
    @endcomponent
    Thank you
</x-mail::message>
