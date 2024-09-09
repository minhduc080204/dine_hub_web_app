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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="disable">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>#{{ $key + 1 }}</td>
                                        <td>{{ $order->user->user_name }}</td>
                                        <td>{{ $order->user->phone_number }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td> {{ $order->order_status }}</td>
                                        <td>
                                            {{-- <a href=""></a> --}}
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
@endsection
