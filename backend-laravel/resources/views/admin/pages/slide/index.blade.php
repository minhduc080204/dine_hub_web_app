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
                                    <th>Image</th>
                                    <th>Last edit</th>
                                    <th>Id</th>
                                    <th class="disable">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $key => $slide)
                                    <tr>
                                        <td><img class="slide_img" src="{{ $slide->image }}" alt=""></td>
                                        <td>{{ $slide->updated_at->format('Y/d/m') }}</td>
                                        <td>{{ $slide->id }}</td>
                                        <td>
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
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <style>
        td,
        th {
            text-align: center;
        }
        .slide_img{
            width: 100px;
        }
    </style>
@endsection
