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
                            <div class="d-flex align-items-center justify-content-between p-3 border-bottom tx-16">
                                <div class="d-flex align-items-center">
                                    <i data-feather="star" class="text-primary icon-lg me-2"></i>
                                    <span>{{ $data['getRecord']->subject }}</span>

                                </div>
                                <div>
                                    <a type="button" href="{{ route('admin.email.read.delete', $data['getRecord']->id) }}"
                                        data-bs-toggle="tooltip" data-bs-title="Delete"><i data-feather="trash"
                                            class="text-muted icon-lg"></i></a>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <img src="https://via.placeholder.com/36x36" alt="Avatar"
                                            class="rounded-circle img-xs">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="text-body">{{ $data['getRecord']->cc_email }}</a>
                                        <span class="mx-2 text-muted">đến</span>
                                        <a href="#" class="text-body me-2">{{ $data['getRecord']->user->email }}</a>
                                    </div>
                                </div>
                                <div class="tx-13 text-muted mt-2 mt-sm-0">
                                    {{ date('d M', strtoTime($data['getRecord']->created_at)) }}
                                </div>
                            </div>
                            <div class="p-4 border-bottom">
                                <p>{{ $data['getRecord']->description }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
