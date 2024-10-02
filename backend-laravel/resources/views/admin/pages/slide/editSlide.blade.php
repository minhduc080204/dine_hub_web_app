@extends('admin.layouts.layout')
@section('content')    
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex gap-3 p-3 pt-0 justify-content-end">
                    <button type="button" id="editSlideButton" class="btn btn-outline-success">Update</button>
                    <form id="removeSlideForm" action="{{ route('admin.slide.remove', ['id' => $slide->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Remove</button>
                    </form>
                </div>
                <form id="editSlideForm" action="{{ route('admin.slide.edit', ['id' => $slide->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')                    
                    <div class="card pt-3">
                        <div class="card-body">
                            <label for="formFile" class="form-label">Hình ảnh</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('editSlideButton').addEventListener('click', function() {
            document.getElementById('editSlideForm').submit();
        });
    </script>
@endsection
