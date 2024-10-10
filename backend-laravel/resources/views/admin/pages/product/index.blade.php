@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end">
                            <a href="{{ route('admin.product.create') }}">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm sản phẩm
                                </button>
                            </a>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Khối lượng</th>
                                    <th>Cập nhật cuối</th>
                                    <th>ID</th>
                                    <th class="Action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        {{-- <td><img src="{{ $product->image && \Storage::disk('public')->exists('images/' . $product->image)
                                            ? asset('storage/images/' . $product->image)
                                            : 'https://png.pngtree.com/png-vector/20220705/ourmid/pngtree-food-logo-png-image_5687686.png' }}"
                                                alt="" width="70" class="rounded">
                                        </td> --}}
                                        <td><img 
                                            src="{{ asset('/storage/images/' . $product->image) }}"
                                            alt="" width="140" class="rounded">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, ',') }} <span
                                                class="text-muted">₫</span></td>
                                        <td>{{ $product->weight }}g</td>
                                        <td> {{ $product->updated_at }}</td>
                                        <td>#{{ $key + 1 }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.product.edit', $product->id) }}">
                                                            <i class="bi bi-pen"></i>Sửa</a></li>
                                                    <li> @deleteItem('admin.product.remove', $product->id)</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
