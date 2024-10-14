@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th class="Action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>#{{ $key + 1 }}</td>
                                        <td>{{ $order->user->user_name }}</td>
                                        <td>{{ $order->user->phone_number }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td> <label  class="orderstatus {{ $order->order_status }}">{{ $order->order_status }}</label></td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.order.detail', $order->id) }}"> <i
                                                                class="bi bi-pen"></i>Chi tiết</a></li>
                                                    @if ($order->order_status == 'canceled')
                                                        <li> @deleteItem('admin.order.remove', $order->id)</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script>
        let abcc = '';
        $.ajax({
            type: "GET",
            url: "/api/orders",
            success: function(data) {
                data.forEach(element => {
                    abcc += `
                        <tr>
                            <td>1</td>
                            <td>${element.user.user_name}</td>
                            <td>${element.user.phone_number}</td>
                            <td>${element.total_price }</td>
                            <td>${element.order_status }</td>
                            <td class="Action">
                                <div class="dropdown">
                                    <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                        aria-expanded="false"></i>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Detail</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                $('#tr').html(abcc);
            }
        });
    </script> --}}
@endsection
