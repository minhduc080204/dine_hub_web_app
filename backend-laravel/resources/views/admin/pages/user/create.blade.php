@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="py-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Thêm
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="note text-end">
                                        <label class="text-danger fw-bolder">Trường có dấu (*) là bắt buộc!</label>
                                    </div>
                                    <div class="input mb-3">
                                        <label for="name" class="fw-bolder mb-1">
                                            Tên người dùng: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                                        @errorDirective('name')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="email" class="fw-bolder mb-1">
                                            Mô tả: <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control no-resize" value="{{ old('email') }}" name="email"
                                            placeholder="Nhập email" id="">
                                        @errorDirective('email')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="email" class="fw-bolder mb-1">
                                            Số điện thoại: <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control no-resize input_number" value="{{ old('phone_number') }}"
                                            name="email" placeholder="Nhập số điện thoại" id="">
                                        @errorDirective('phone_number')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="role" class="fw-bolder mb-1">
                                            Vai trò:
                                        </label>
                                        <select name="role" id="" class="form-control">
                                            <option value="agent">-- Người dùng</option>
                                            <option value="admin">-- Quản trị</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
