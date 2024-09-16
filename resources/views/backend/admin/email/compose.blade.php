@extends('backend.admin.layout')
@section('admin')
    <div class="row inbox-wrapper">
        <div class="col-lg-12">
            @include('backend.admin._message')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 border-end-lg">
                            <div class="aside-content">
                                @include('backend.admin.email.components.sidebar')
                                
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div>
                                <div class="d-flex align-items-center p-3 border-bottom tx-16">
                                    <span data-feather="edit" class="icon-md me-2"></span>
                                    Tin nhắn mail mới
                                </div>
                            </div>
                            <form action="{{ route('admin.email.compose') }}" method="POST">
                                @csrf
                                <div class="p-3 pb-0">
                                    <div class="to">
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Đến:</label>
                                            <div class="col-md-10">
                                                <select class="compose-multiple-select form-select" name="user_id">
                                                    <option value="">Chọn email [Agent/User]:</option>
                                                    @if (isset($data['getEmail']))
                                                        @foreach ($data['getEmail'] as $key => $val)
                                                            <option value="{{ $val->id }}">{{ $val->email }} -
                                                                {{ $val->role }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="to cc">
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Từ:</label>
                                            <div class="col-md-10">
                                                <input type="email" name="cc_email" class="form-control"
                                                    placeholder="Vui lòng nhập email muốn gửi đến...">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="subject">
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Subject:</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="subject" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label ">
                                                Mô tả:
                                            </label>
                                            <textarea class="form-control" name="description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary me-1 mb-1" type="submit"> Gửi Email</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
