@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="py-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Sửa
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="note text-end">
                                        <label class="text-danger fw-bolder">Trường có dấu (*) là bắt buộc!</label>
                                    </div>
                                    <div class="input mb-3">
                                        <label for="code" class="fw-bolder mb-1">
                                            Mã mới: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="code" id="codes-input" class="form-control"
                                            placeholder="Nhập mã giảm giá mới" value="{{ $coupon->code }}">
                                        @errorDirective('code')
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="discount" class="fw-bolder mb-1">
                                            Giảm giá: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="discount" id="discount"
                                            class="form-control input_discount input_number"
                                            placeholder="Nhập số % được giảm" value="{{ $coupon->discount }}">
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">%</label>
                                        @errorDirective('discount')
                                    </div>
                                    <div class="input mb-3">
                                        <label for="expires_at" class="fw-bolder mb-1">
                                            Ngày hết hạn:
                                        </label>
                                        <input type="date" name="expires_at" id="expires_at" class="form-control"
                                            placeholder="Gắn thẻ" value="{{ $coupon->expires_at }}">
                                        <p for="" class="text-warning" style="font-size: 12px">
                                            (!) Để trống coi như mã có hiệu lực vĩnh viễn</p>
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
