@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end">
                            <a href="{{ route('admin.discount.create') }}">
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
                                @foreach ($discounts as $key => $discount)
                                    <tr>
                                        <td>{{ $discount->code }}</td>
                                        <td>{{ $discount->expires_at }}</td>
                                        <td>{{ $discount->updated_at }}</td>
                                        <td> {{ $discount->discount }}%</td>
                                        <td>#{{ $key + 1 }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.product.edit', $discount->id) }}">
                                                            <i class="bi bi-pen"></i>Sửa</a></li>
                                                    <li><a class="dropdown-item" href="#"> <i
                                                                class="bi bi-trash"></i>Xoá</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $discounts->onEachSide(2)->links() }} --}}
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
