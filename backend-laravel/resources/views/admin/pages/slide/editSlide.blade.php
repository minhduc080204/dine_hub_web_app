@extends('admin.layouts.layout')
@section('content')
    @php
        $slide = $slide->first();
    @endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex gap-3 p-3 pt-0 justify-content-end">
                    <form id="post-form" action="{{ route('admin.silde.remove', ['id' => $slide->id]) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-outline-success">Sửa</button>
                    </form>
                    <form id="post-form" action="{{ route('admin.silde.remove', ['id' => $slide->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Xoá</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body mt-3 d-flex justify-content-between">
                        <div>
                            <label for="formFile" class="form-label">Ảnh</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
