(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr("content");


    HT.refreshCaptcha = () => {
        $(".refresh-captcha").click(function (e) {
            $.ajax({
                type: "GET",
                url: "refreshCaptcha",
                success: function (data) {
                    $("#captcha-img").html(data.captcha);
                },
            });
        });
    };
    HT.switchStatus = () => {
        $(".toggle-status-btn").click(function () {
            var userId = $(this).data("user-id");
            var button = $(this); // Lưu tham chiếu đến nút

            $.ajax({
                url: 'users/toggle-status',
                type: "POST",
                data: {
                    user_id: userId,
                    _token, // CSRF token cho bảo mật
                },
                success: function (response) {
                    if (response.success) {
                        // Cập nhật trạng thái hiển thị
                        if (response.status) {
                            $("#status-" + userId).text("Kích hoạt");
                            $("#status-" + userId).removeClass('bg-danger').addClass('bg-primary');
                            button.text("Ngừng kích hoạt");
                            button.removeClass('btn-primary').addClass('btn-danger');
                            
                        } else {
                            $("#status-" + userId).text("Không kích hoạt");
                            $("#status-" + userId).removeClass('bg-primary').addClass('bg-danger');
                            button.text("Kích hoạt");
                            button.removeClass('btn-danger').addClass('btn-primary');
                        }
                    } else {
                        alert("Không tìm thấy người dùng");
                    }
                },
                error: function (error) {
                    alert(error);
                },
            });
        });
    };
    $(document).ready(function () {
        HT.refreshCaptcha();
        HT.switchStatus();
    });
})(jQuery);
