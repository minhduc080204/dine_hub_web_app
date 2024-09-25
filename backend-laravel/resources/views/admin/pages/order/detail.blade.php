@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-secondary">
                                Cập nhật
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input mb-3 position-relative">
                                    <label for="name" class="fw-bolder mb-1">
                                        Tên khách hàng:
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nhập tên sản phẩm" value="{{ $order->user->user_name }}" disabled>
                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="description" class="fw-bolder mb-1">
                                        Email:
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nhập tên sản phẩm" value="{{ $order->user->email }}" disabled>
                                </div>
                                <div class="input mb-3 position-relative ">
                                    <label for="price" class="fw-bolder mb-1">
                                        Số điện thoại:
                                    </label>
                                    <input type="text" name="price" id="price" class="form-control input_number"
                                        placeholder="Nhập giá tiền" value="{{ $order->user->phone_number }}" disabled>
                                </div>
                                <div class="input mb-3 position-relative ">
                                    <label for="weight" class="fw-bolder mb-1">
                                        Địa chỉ:
                                    </label>
                                    <input type="text" name="weight" id="weight" class="form-control input_number"
                                        placeholder="Nhập khối lượng" value="{{ $order->address }}" disabled>

                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="calories" class="fw-bolder mb-1">
                                        Tổng tiền:
                                    </label>
                                    <input type="text" name="calories" id="calories" class="form-control input_number"
                                        placeholder="Nhập năng lượng"
                                        value="{{ number_format($order->total_price, 0, ',') }}" disabled>
                                    <label for="" class="text-muted position-absolute"
                                        style="top:55%; right:10px">VNĐ</label>
                                </div>
                                <div class="input mb-3 position-relative ">
                                    <label for="category" class="fw-bolder mb-1">
                                        Tổng tiền:
                                    </label>
                                    <input type="text" name="category"
                                        value="{{ number_format($order->subtotal_price, 0, ',') }}" disabled
                                        class="form-control" placeholder="Nhập tên sản phẩm">
                                    <label for="" class="text-muted position-absolute"
                                        style="top:55%; right:10px">VNĐ</label>
                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="tag" class="fw-bolder mb-1">
                                        Tiền giao hàng:
                                    </label>
                                    <input type="text" name="tag" class="form-control" placeholder="Gắn thẻ"
                                        value="{{ number_format($order->delivery_price, 0, ',') }}" disabled>
                                    <label for="" class="text-muted position-absolute"
                                        style="top:55%; right:10px">VNĐ</label>
                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="image" class="fw-bolder mb-1">
                                        Giảm giá:
                                    </label>
                                    <input type="text" name="image1" id="image" class="form-control"
                                        value="{{ $order->discount }}" disabled>
                                    <label for="" class="text-muted position-absolute"
                                        style="top:55%; right:10px">%</label>
                                </div>


                                <div class="input mb-3 position-relative">
                                    <label for="image" class="fw-bolder mb-1">
                                        Trạng thái thành toán:
                                    </label>
                                    <input type="text" name="image1" id="image" class="form-control"
                                        value="{{ $order->payment_status }}" disabled>
                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="image" class="fw-bolder mb-1">
                                        Trạng thái đơn hàng:
                                    </label>
                                    <input type="text" name="image1" id="image" class="form-control"
                                        value="{{ $order->order_status }}" disabled>
                                </div>
                                <div class="input mb-3 position-relative">
                                    <label for="image" class="fw-bolder mb-1">
                                        Ngày mua:
                                    </label>
                                    <input type="text" name="image1" id="image" class="form-control"
                                        value="{{ $order->created_at }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
