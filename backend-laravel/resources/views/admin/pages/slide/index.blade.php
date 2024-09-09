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
                                    <th class="disable Action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $key => $slide)
                                    <tr>
                                        <td><img class="slide_img" src="{{ $slide->image }}" alt="img" width="150"></td>
                                        <td>{{ $slide->updated_at->format('Y/d/m') }}</td>
                                        <td>{{ $slide->id }}</td>
                                        <td class="Action">
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <form id="post-form" action="{{ route('admin.silde.remove', ['id' => $slide->id]) }}" method="POST">
                                                        @csrf
                                                        <li><a class="dropdown-item" href="{{ route('admin.silde.edit.view', ['id' => $slide->id]) }}">Edit</a></li>
    
                                                        <li><button type="submit" class="dropdown-item">Delete</button></li>
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
