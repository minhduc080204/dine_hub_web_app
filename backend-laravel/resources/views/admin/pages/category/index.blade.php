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
                                    <th>Id</th>
                                    <th>Ảnh</th>
                                    <th>Tên danh mục</th>
                                    <th>Cập nhật cuối</th>
                                    <th class="disable Action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categogies as $key => $category)
                                    <tr>
                                        <td>#{{ $key + 1 }}</td>
                                        <td><img class="category_img" src="{{ $category->image }}" alt="img"
                                                width="150" style="max-height: 120px"></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <form id="post-form"
                                                        action="{{ route('admin.category.remove', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.category.edit.view', ['id' => $category->id]) }}">Sửa</a>
                                                        </li>

                                                        <li><button type="submit" class="dropdown-item">Xoá</button>
                                                        </li>
                                                    </form>
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
@endsection
