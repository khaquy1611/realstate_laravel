<div class="d-flex align-items-center justify-content-between">
    <button class="navbar-toggle btn btn-icon border d-block d-lg-none" data-bs-target=".email-aside-nav"
        data-bs-toggle="collapse" type="button">
        <span class="icon"><i data-feather="chevron-down"></i></span>
    </button>
    <div class="order-first">
        <h4>Dịch vụ Email</h4>
        <p class="text-muted">{{ Auth::user()->email }}</p>
    </div>

</div>

<div class="d-grid my-3">
    <a class="btn btn-primary" href="{{ route('admin.email.compose') }}">Soạn Email</a>
</div>
<div class="email-aside-nav collapse">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="../email/inbox.html">
                <i data-feather="inbox" class="icon-lg me-2"></i>
                Inbox
                <span class="badge bg-danger fw-bolder ms-auto">2
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link d-flex align-items-center" href="{{ route('admin.email.send') }}">
                <i data-feather="mail" class="icon-lg me-2"></i>
                Thư đã gửi
            </a>
        </li>

    </ul>
    <p class="text-muted tx-12 fw-bolder text-uppercase mb-2 mt-4">Labels</p>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i data-feather="tag" class="text-warning icon-lg me-2"></i>
                Important
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i data-feather="tag" class="text-primary icon-lg me-2"></i>
                Business
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i data-feather="tag" class="text-info icon-lg me-2"></i>
                Inspiration
            </a>
        </li>
    </ul>
</div>
