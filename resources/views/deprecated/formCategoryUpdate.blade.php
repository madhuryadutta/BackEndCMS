@extends('layouts.main')
@push('title')
    <title>category</title>
@endpush
@section('main-section')
    <div class="bg-body-tertiary p-5 mt-3 rounded">
        <div class="container">
            <div class="container">
                <h1>manage categories</h1>
                <form enctype="multipart/form-data" method="POST"
                    action="{{ route('updateCategory', ['id' => $currentCategory->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Parent Category</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="parentCategory">
                            <option value="0"
                                {{ isset($currentCategory) && $currentCategory->parent_id == 0 ? 'selected' : '' }}>Not
                                applicable</option>
                            @foreach ($categoryList as $option)
                                <option value="{{ $option->id }}"
                                    {{ isset($currentCategory) && $option->id == $currentCategory->parent_id ? 'selected' : '' }}>
                                    {{ $option->category_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category Name</label>
                        <input type="text" class="form-control" name="categoryName" id="exampleFormControlInput1"
                            value={{ isset($currentCategory) ? $currentCategory->category_name : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Active Status</label>
                        <select class="form-control" name="is_active" id="exampleFormControlSelect1">
                            <option value="1"
                                {{ isset($currentCategory) && $currentCategory->is_active == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0"
                                {{ isset($currentCategory) && $currentCategory->is_active == 0 ? 'selected' : '' }}>Not Active
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">save</button>
                </form>
            </div>
        </div>
        <div class="container">
            @foreach ($categoryList as $category)
                <div class="row">{{ $category->category_name }}</div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
