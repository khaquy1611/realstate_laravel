@extends('backend.admin.layout')
@section('admin')
    @include('backend.admin._message')
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                @include('backend.admin.profiles.components.profile-infomation')
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Cập nhập profiles</h6>

                        <form class="forms-sample" action="{{ route('admin.profiles.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên:</label>
                                <input type="text" class="form-control" placeholder="Name..." name="name"
                                    value="{{ $data['getRecord']->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Họ:</label>
                                <input type="text" class="form-control" placeholder="Username..." name="username"
                                    value="{{ $data['getRecord']->username }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email..."
                                    value="{{ $data['getRecord']->email }}">
                                <span style="color: red;">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại:</label>
                                <input type="text" class="form-control" placeholder="Phone..." name="phone"
                                    value="{{ $data['getRecord']->phone }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ:</label>
                                <input type="text" class="form-control" placeholder="Address..." name="address"
                                    value="{{ $data['getRecord']->address }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website:</label>
                                <input type="text" class="form-control" placeholder="Website..." name="website"
                                    value="{{ $data['getRecord']->website }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Password..." name="password">
                                ( Vui lòng để trống nếu không thay đổi mật khẩu )
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ảnh đại diện:</label>
                                <input type="file" class="form-control" name="photo">
                                @if (!empty($data['getRecord']->photo))
                                    <img src="{{ asset('upload/' . $data['getRecord']->photo) }}"
                                        style="width: 10%; height: 10%; border-radius: 50px; margin: 10px 0;"
                                        alt="image profiles previews">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Về chúng tôi:</label>
                                <textarea type="text" class="form-control" name="about" cols="30" rows="8">
                                    {{ $data['getRecord']->about }}
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Cập nhập profiles</button>
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
