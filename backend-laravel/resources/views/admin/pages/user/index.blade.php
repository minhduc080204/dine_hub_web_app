@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end">
                            <a href="{{ route('admin.user.create') }}">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm người dùng
                                </button>
                            </a>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Cập nhật cuối</th>
                                    <th class="Action">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr class="{{ Auth::user()->email == $user->email ? 'table-primary' : '' }}">
                                        <td>#{{ $key + 1 }}</td>
                                        <td><img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/01/meme-la-gi-18.jpg"
                                                alt="image" width="70"></td>
                                        <td>
                                            {{ $user->user_name }}
                                            {!! Auth::user()->email == $user->email ? '<span class="text-danger fw-bold"> (me)</span>' : '' !!}
                                        </td>
                                        <td> {{ $user->updated_at }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                    style="{{ Auth::user()->email == $user->email ? 'display:none ' : '' }}"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.user.edit', $user->id) }}">
                                                            <i class="bi bi-pen"></i>Sửa</a></li>
                                                    <li>@deleteItem('admin.user.remove', $user->id)</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $products->onEachSide(2)->links() }} --}}
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
