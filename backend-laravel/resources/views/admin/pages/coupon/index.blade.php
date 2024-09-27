@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.coupon.reload') }}">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i>
                                    Cài lại
                                </button>
                            </a>
                            <a href="{{ route('admin.coupon.create') }}">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm mã giảm giá
                                </button>
                            </a>

                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Hết hạn</th>
                                    <th>Cập nhật cuối</th>
                                    <th>Giảm giá</th>
                                    <th>ID</th>
                                    <th class="Action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($coupons) --}}
                                @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->expires_at == null ? 'Vĩnh viễn' : $coupon->expires_at }}</td>
                                        <td>{{ $coupon->updated_at }}</td>
                                        <td> {{ $coupon->discount }}%</td>
                                        <td>#{{ $key + 1 }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.coupon.edit', $coupon->id) }}">
                                                            <i class="bi bi-pen"></i>Sửa</a></li>
                                                    <li> @deleteItem('admin.coupon.remove', $coupon->id)</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $coupons->onEachSide(2)->links() }} --}}
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
