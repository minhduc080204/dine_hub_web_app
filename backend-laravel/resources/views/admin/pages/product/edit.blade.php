@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="post"
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
                                            Tên sản phẩm: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                                        @errorDirective('name')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="description" class="fw-bolder mb-1">
                                            Mô tả: <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control no-resize" name="description" rows="5" placeholder="Nhập mô tả ngắn" id="">{{ $product->description }}</textarea>
                                        @errorDirective('description')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="price" class="fw-bolder mb-1">
                                            Giá: <span class="text-danger">*</span> (VNĐ)
                                        </label>
                                        <input type="text" name="price" id="price"
                                            class="form-control input_number" placeholder="Nhập giá tiền"
                                            value="{{ $product->price }}">
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">VNĐ</label>
                                        @errorDirective('price')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="weight" class="fw-bolder mb-1">
                                            Khối lượng: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="weight" id="weight"
                                            class="form-control input_number" placeholder="Nhập khối lượng"
                                            value="{{ $product->weight }}">
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">g</label>
                                        @errorDirective('weight')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="calories" class="fw-bolder mb-1">
                                            Năng lượng: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="calories" id="calories"
                                            class="form-control input_number" placeholder="Nhập năng lượng"
                                            value="{{ $product->calories }}">
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">calories</label>
                                        @errorDirective('calories')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="category" class="fw-bolder mb-1">
                                            Danh mục:
                                        </label>
                                        <input type="text" name="category" id="categories-input"
                                            value="{{ $product->category }}" class="form-control"
                                            placeholder="Nhập tên sản phẩm">
                                        {{-- @dd($product->category) --}}
                                    </div>
                                    <div class="input mb-3">
                                        <label for="tag" class="fw-bolder mb-1">
                                            Thẻ:
                                        </label>

                                        <input type="text" name="tag" id="tags-input" class="form-control"
                                            placeholder="Gắn thẻ"
                                            value="{{ $product->tags->pluck('name')->implode(', ') }}">

                                    </div>
                                    <div class="input mb-3">
                                        <label for="image" class="fw-bolder mb-1">
                                            Ảnh: <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" name="image" id="image" class="form-control img-test">
                                        <input type="hidden" name="image1" id="image" class="form-control"
                                            value="{{ $product->image }}">
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
                                id="flexCheckChecked" {{ $product->is_new = 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckChecked">
                                Mới
                            </label>
                        </div>
                        <div class="form-check my-1">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Nổi bật
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_bestseller"
                                id="flexCheckDefault" {{ $product->is_bestseller = 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
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
