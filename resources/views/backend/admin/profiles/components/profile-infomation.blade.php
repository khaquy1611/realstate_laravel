<div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h6 class="card-title mb-0">About</h6>

    </div>
    <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of Social.
    </p>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
        <p class="text-muted">{{ Auth::user()->name }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">UsserName:</label>
        <p class="text-muted">{{ Auth::user()->username }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
        <p class="text-muted">{{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
        <p class="text-muted">{{ Auth::user()->email }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
        <p class="text-muted">{{ Auth::user()->phone }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Adress:</label>
        <p class="text-muted">{{ Auth::user()->address }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">About:</label>
        <p class="text-muted">{{ Auth::user()->about }}</p>
    </div>
    <div class="mt-3">
        <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
        <p class="text-muted">{{ Auth::user()->website }}</p>
    </div>
</div>
