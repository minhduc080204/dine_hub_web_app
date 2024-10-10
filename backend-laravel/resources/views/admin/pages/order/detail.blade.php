@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                         
                            <div class="py-3 d-flex justify-content-end gap-3">
                                @if($order->order_status == 'Processing')
                                <button type="submit" name="action" value="accept" class="btn btn-outline-success">
                                    Nhận đơn
                                </button>
                                <button type="submit" name="action" value="cancel" class="btn btn-outline-danger">
                                    Huỷ đơn
                                </button>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input mb-3 position-relative">
                                        <label for="user_name" class="fw-bolder mb-1">
                                            Tên khách hàng:
                                        </label>
                                        <input type="text" name="user_name" id="user_name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ $order->user->user_name }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="email" class="fw-bolder mb-1">
                                            Email:
                                        </label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Nhập tên sản phẩm" value="{{ $order->user->email }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative ">
                                        <label for="phone_number" class="fw-bolder mb-1">
                                            Số điện thoại:
                                        </label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            class="form-control input_number" placeholder="Nhập giá tiền"
                                            value="{{ $order->user->phone_number }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative ">
                                        <label for="address" class="fw-bolder mb-1">
                                            Địa chỉ:
                                        </label>
                                        <input type="text" name="address" id="address"
                                            class="form-control input_number" placeholder="Nhập khối lượng"
                                            value="{{ $order->address }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="total_price" class="fw-bolder mb-1">
                                            Tổng tiền:
                                        </label>
                                        <input type="text" name="total_price" id="total_price"
                                            class="form-control input_number" placeholder="Nhập năng lượng"
                                            value="{{ number_format($order->total_price, 0, ',') }}" disabled>
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">VNĐ</label>
                                    </div>
                                    <div class="input mb-3 position-relative ">
                                        <label for="subtotal_price" class="fw-bolder mb-1">
                                            Tổng tiền:
                                        </label>
                                        <input type="text" name="subtotal_price"
                                            value="{{ number_format($order->subtotal_price, 0, ',') }}" disabled
                                            class="form-control" placeholder="Nhập tên sản phẩm">
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">VNĐ</label>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="delivery_price" class="fw-bolder mb-1">
                                            Tiền giao hàng:
                                        </label>
                                        <input type="text" name="delivery_price" class="form-control"
                                            placeholder="Gắn thẻ"
                                            value="{{ number_format($order->delivery_price, 0, ',') }}" disabled>
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">VNĐ</label>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="discount" class="fw-bolder mb-1">
                                            Giảm giá:
                                        </label>
                                        <input type="text" name="discount" id="discount" class="form-control"
                                            value="{{ $order->discount }}" disabled>
                                        <label for="" class="text-muted position-absolute"
                                            style="top:55%; right:10px">%</label>
                                    </div>


                                    <div class="input mb-3 position-relative">
                                        <label for="payment_status" class="fw-bolder mb-1">
                                            Trạng thái thành toán:
                                        </label>
                                        <input type="text" name="payment_status" id="payment_status"
                                            class="form-control" value="{{ $order->payment_status }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="order_status" class="fw-bolder mb-1">
                                            Trạng thái đơn hàng:
                                        </label>
                                        <input type="text" name="order_status" id="order_status" class="form-control"
                                            value="{{ $order->order_status }}" disabled>
                                    </div>
                                    <div class="input mb-3 position-relative">
                                        <label for="created_at" class="fw-bolder mb-1">
                                            Ngày mua:
                                        </label>
                                        <input type="text" name="created_at" id="created_at" class="form-control"
                                            value="{{ $order->created_at }}" disabled>
                                    </div>
                                    <p class="fs-2 text-muted">Danh sách sản phẩm</p>
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $key => $product)
                                                    <tr>
                                                        <td><img src="{{ asset('/storage/images/' . $product->image) }}"
                                                                alt="" width="140" class="rounded">
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ number_format($product->price, 0, ',') }} <span
                                                                class="text-decoration-underline text-muted">đ</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
