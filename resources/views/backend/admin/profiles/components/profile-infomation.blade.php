<div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h6 class="card-title mb-0">Về chúng tôi:</h6>

    </div>
    <p>{{ Auth::user()->about }}</p>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Tên:</label>
        <p class="text-muted">{{ Auth::user()->name }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Họ:</label>
        <p class="text-muted">{{ Auth::user()->username }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Ngày tham gia:</label>
        <p class="text-muted">{{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
        <p class="text-muted">{{ Auth::user()->email }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Số điện thoại:</label>
        <p class="text-muted">{{ Auth::user()->phone }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Địa chỉ:</label>
        <p class="text-muted">{{ Auth::user()->address }}</p>
    </div>

    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
        <p class="text-muted">{{ Auth::user()->website }}</p>
    </div>
</div>
