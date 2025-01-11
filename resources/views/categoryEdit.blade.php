@extends('layouts.main')
@push('title')
    <title>{{ config('app.name') }}</title>
@endpush
@section('main-section')
    <section class="section dashboard">




        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> {{ isset($currentCategory) ? 'Edit Category' : 'Add Category' }}</h5>

                            <form class="row g-3" enctype="multipart/form-data" method="POST"
                                action="{{ route(isset($currentCategory) ? 'updateCategory' : 'addCategory', isset($currentCategory) ? ['id' => $currentCategory->id] : []) }}
">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" aria-label="State"
                                            name="parentCategory">
                                            <option value="0"
                                                {{ isset($currentCategory) && $currentCategory->parent_id == 0 ? 'selected' : '' }}>
                                                Not applicable</option>
                                            @foreach ($categoryList as $option)
                                                <option value="{{ $option->id }}"
                                                    {{ isset($currentCategory) && $option->id == $currentCategory->parent_id ? 'selected' : '' }}>
                                                    {{ $option->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingName">Parent Category</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingEmail" name="categoryName"
                                            placeholder="Category Name"
                                            value={{ isset($currentCategory) ? $currentCategory->category_name : '' }}>
                                        <label for="floatingEmail">Category Name</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                                        <label for="floatingTextarea">Note</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="is_active" id="floatingSelect" aria-label="State">
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
                                        <label for="floatingSelect">Active Status</label>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End floating Labels Form -->

                        </div>
                    </div>


                </div>

            </div>
        </div>




        </div>
    </section>
@endsection
