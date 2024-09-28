@extends('admin.layouts.layout')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="py-3 d-flex justify-content-end">
                            <a href="{{ route('admin.tag.create') }}">
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-plus-circle"></i>
                                    Thêm thẻ mới
                                </button>
                            </a>
                        </div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Cập nhật cuối</th>
                                    <th>ID</th>
                                    <th class="Action">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $key => $tag)
                                    <tr>
                                        <td>{{ $tag->name }}</td>
                                        <td> {{ $tag->updated_at }}</td>
                                        <td>#{{ $key + 1 }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.tag.edit', $tag->id) }}">
                                                            <i class="bi bi-pen"></i>Sửa</a></li>
                                                    <li> @deleteItem('admin.tag.remove', $tag->id)</li>

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
