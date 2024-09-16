(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr("content");
    HT.customUsersCharts = () => {
        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#b8c3d9",
            cardBg: "#0c1427",
        };

        var fontFamily = "'Roboto', Helvetica, sans-serif";

        // Monthly Users Chart
        if($('#monthlyUsersChart').length) {
            var options = {
              chart: {
                type: 'bar',
                height: '318',
                parentHeightOffset: 0,
                foreColor: colors.bodyColor,
                background: colors.cardBg,
                toolbar: {
                  show: false
                },
              },
              theme: {
                mode: 'light'
              },
              tooltip: {
                theme: 'light'
              },
              colors: [colors.primary],  
              fill: {
                opacity: .9
              } , 
              grid: {
                padding: {
                  bottom: -4
                },
                borderColor: colors.gridBorder,
                xaxis: {
                  lines: {
                    show: true
                  }
                }
              },
              series: [{
                name: 'Người dùng',
                data: counts
              }],
              xaxis: {
                type: 'datetime',
                categories: months,
                axisBorder: {
                  color: colors.gridBorder,
                },
                axisTicks: {
                  color: colors.gridBorder,
                },
              },
              yaxis: {
                title: {
                  text: 'Số lượng người dùng',
                  style:{
                    size: 9,
                    color: colors.muted
                  }
                },
              },
              legend: {
                show: true,
                position: "top",
                horizontalAlign: 'center',
                fontFamily: fontFamily,
                itemMargin: {
                  horizontal: 8,
                  vertical: 0
                },
              },
              stroke: {
                width: 0
              },
              dataLabels: {
                enabled: true,
                style: {
                  fontSize: '10px',
                  fontFamily: fontFamily,
                },
                offsetY: -27
              },
              plotOptions: {
                bar: {
                  columnWidth: "50%",
                  borderRadius: 4,
                  dataLabels: {
                    position: 'top',
                    orientation: 'vertical',
                  }
                },
              },
            }
            
            var apexBarChart = new ApexCharts(document.querySelector("#monthlyUsersChart"), options);
            apexBarChart.render();
          }
        // Monthly Sales Chart - RTL - END
    };

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
                url: "users/toggle-status",
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
                            $("#status-" + userId)
                                .removeClass("bg-danger")
                                .addClass("bg-primary");
                            button.text("Ngừng kích hoạt");
                            button
                                .removeClass("btn-primary")
                                .addClass("btn-danger");
                        } else {
                            $("#status-" + userId).text("Không kích hoạt");
                            $("#status-" + userId)
                                .removeClass("bg-primary")
                                .addClass("bg-danger");
                            button.text("Kích hoạt");
                            button
                                .removeClass("btn-danger")
                                .addClass("btn-primary");
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
    HT.deleteListMail = () => {
        $('.delete-all-option').change(function() {
            let total = '';
            $('.delete-all-option').each(function() {
                if (this.checked) {
                    let id = $(this).val();
                    total += id + ',';
                }
            }); 
           
            let url = urlMailDelete + total;
            $('#getDeleteUrl').attr('href', url);
        })
    }
    $(document).ready(function () {
        HT.refreshCaptcha();
        HT.switchStatus();
        HT.customUsersCharts();
        HT.deleteListMail();
    });
})(jQuery);
