@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.tag.store') }}" method="post">
                            @csrf
                            <div class="py-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm thẻ mới
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="note text-end">
                                        <label class="text-danger fw-bolder">Trường có dấu (*) là bắt buộc!</label>
                                    </div>
                                    <div class="input mb-3">
                                        <label for="name" class="fw-bolder mb-1">
                                            Tên thẻ: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nhập tên thẻ" value="{{ old('name') }}">
                                        @errorDirective('name')
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
