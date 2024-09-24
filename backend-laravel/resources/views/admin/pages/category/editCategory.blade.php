@extends('admin.layouts.layout')
@section('content')
    @php
        $category = $category->first();
    @endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex gap-3 p-3 pt-0 justify-content-end">
                    <button type="button" id="editCategoryButton" class="btn btn-outline-success">Update</button>
                    <form id="removeCategoryForm" action="{{ route('admin.category.remove', ['id' => $category->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Remove</button>
                    </form>
                </div>
                <form id="editCategoryForm" action="{{ route('admin.category.edit', ['id' => $category->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" value="{{ $category->name }}" style="display: none" id="oldCategory"
                        name="oldCategory">
                    <div class="card pt-3">
                        <div class="card-body">
                            <label for="newCategory" class="form-label">Tên danh mục</label>
                            <input class="form-control" type="text" id="newCategory" name="newCategory"
                                placeholder="Name of Category" value="{{ $category->name }}">
                        </div>
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
        document.getElementById('editCategoryButton').addEventListener('click', function() {
            document.getElementById('editCategoryForm').submit();
        });
    </script>
@endsection
