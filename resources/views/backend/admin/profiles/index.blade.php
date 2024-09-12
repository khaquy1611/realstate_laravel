@extends('backend.admin.layout')
@section('admin')
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">About</h6>

                    </div>
                    <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of Social.
                    </p>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                        <p class="text-muted">Admin Viper</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
                        <p class="text-muted">November 15, 2015</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
                        <p class="text-muted">New York, USA</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">me@nobleui.com</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                        <p class="text-muted">www.nobleui.com</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Profiles Update</h6>

                        <form class="forms-sample">
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control" placeholder="Name..." name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">UserName:</label>
                                <input type="text" class="form-control" placeholder="Username..." name="username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password:</label>
                                <input type="password" class="form-control" placeholder="Password..." name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Profiles Images:</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address:</label>
                                <input type="text" class="form-control" placeholder="Address..." name="address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">About:</label>
                                <textarea type="text" class="form-control" name="about" id="" cols="30" rows="8"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website:</label>
                                <input type="text" class="form-control" placeholder="Website..." name="website">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>



        </div>
        <!-- middle wrapper end -->
        <!-- right wrapper start -->

        <!-- right wrapper end -->
    </div>
@endsection
