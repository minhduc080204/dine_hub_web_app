@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="py-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Cập nhật
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
                                            placeholder="Nhập tên sản phẩm" value="{{ $user->user_name }}">
                                        @errorDirective('name')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="email" class="fw-bolder mb-1">
                                            Email: <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control no-resize" value="{{ $user->email }}" name="email"
                                            placeholder="Nhập email" id="">
                                        @errorDirective('email')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="phone_number" class="fw-bolder mb-1">
                                            Số điện thoại: <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control no-resize input_number" value="{{ $user->phone_number }}"
                                            name="phone_number" placeholder="Nhập số điện thoại" id="">
                                        @errorDirective('phone_number')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="role" class="fw-bolder mb-1">
                                            Vai trò:
                                        </label>
                                        <select name="role" id="" class="form-control">
                                            <option value="agent" {{ $user->role == 'admin' ? '' : 'selected' }}>-- Người
                                                dùng
                                            </option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>-- Quản
                                                trị
                                            </option>
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
