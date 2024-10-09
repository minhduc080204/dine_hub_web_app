@extends('admin.layouts.layout')
@section('content')
    <style>
        input:focus {
            box-shadow: unset !important;
        }

            
    </style>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="py-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm sản phẩm
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="note text-end">
                                        <label class="text-danger fw-bolder">Trường có dấu (*) là bắt buộc!</label>
                                    </div>
                                    <div class="input mb-3">
                                        <label for="name" class="fw-bolder mb-1">
                                            Tên sản phẩm: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                                        @errorDirective('name')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="description" class="fw-bolder mb-1">
                                            Mô tả: <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control no-resize" name="description" rows="5" placeholder="Nhập mô tả ngắn" id="">{{ old('description') }}</textarea>
                                        @errorDirective('description')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="price" class="fw-bolder mb-1">
                                            Giá: <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-control d-flex p-1">
                                            <input type="text" name="price" id="price"
                                                class="form-control input_number border-0" placeholder="Nhập giá tiền"
                                                value="{{ old('price') }}">
                                            <span for="price"
                                                class="text_note text-muted align-self-center pe-2">VNĐ</span>
                                        </div>
                                        @errorDirective('price')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="weight" class="fw-bolder mb-1">
                                            Khối lượng: <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-control d-flex p-1">
                                            <input type="text" name="weight" id="weight"
                                                class="form-control input_number border-0" placeholder="Nhập khối lượng"
                                                value="{{ old('weight') }}">
                                            <label for="weight"
                                                class="text_note text-muted align-self-center pe-2">g</label>
                                        </div>
                                        @errorDirective('weight')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="calories" class="fw-bolder mb-1">
                                            Năng lượng: <span class="text-danger">*</span>
                                        </label>
                                        <div class="form-control d-flex p-1">
                                            <input type="text" name="calories" id="calories"
                                                class="form-control input_number border-0" placeholder="Nhập năng lượng"
                                                value="{{ old('calories') }}">
                                            <label for="calories"
                                                class="text_note text-muted align-self-center pe-2">calories</label>
                                        </div>
                                        @errorDirective('calories')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="category" class="fw-bolder mb-1">
                                            Danh mục: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="category" id="categories-input" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ old('category') }}">
                                        @errorDirective('category')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="tag" class="fw-bolder mb-1">
                                            Thẻ:
                                        </label>
                                        <input type="text" name="tag" id="tags-input" class="form-control"
                                            placeholder="Gắn thẻ" value="{{ old('tag') }}">
                                        @errorDirective('tag')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="image" class="fw-bolder mb-1">
                                            Ảnh: <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            value="{{ old('image') }}">
                                        @errorDirective('image')
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_new"
                                id="is_new" checked>
                            <label class="form-check-label" for="is_new">
                                Mới
                            </label>
                        </div>
                        <div class="form-check my-1">
                            <input class="form-check-input" type="checkbox" value="1" name="is_"
                                id="is_">
                            <label class="form-check-label" for="is_">
                                Nổi bật
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_bestseller"
                                id="is_bestseller">
                            <label class="form-check-label" for="is_bestseller">
                                Đề xuất
                            </label>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
