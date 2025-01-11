@extends('layouts.main')
@push('title')
    <title>{{ config('app.name') }}</title>
@endpush
@section('main-section')
    <section class="section dashboard">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ isset($SingleContent) ? 'Edit Content' : 'Create Content' }}</h5>

                    <form method="POST"
                        action=" {{ route(isset($SingleContent) ? 'save.content' : 'save.content', isset($SingleContent) ? ['id' => $SingleContent->id] : []) }}">
                        @csrf
                        <!-- TinyMCE Editor -->

                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="text" class="form-control"name="title" id="title"
                                    placeholder="Write A suitable Headline for your Content"
                                    value={{ isset($SingleContent) ? $SingleContent->title : '' }}>
                            </div>
                            <div class="col-md-4">
                                <select name='category' id="category" class="form-select">
                                    <option>-- Select Category--</option>
                                    @foreach ($categoryOption as $option)
                                        <option value={{ $option->id }}
                                            {{ isset($SingleContent) && $option->id == $SingleContent->fk_category_id ? 'selected' : '' }}>
                                            {{ $option->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check form-switch">

                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Publish</label>
                            </div>
                        </div>
                        <hr>

                        <textarea class="tinymce-editor" name="contentToSave">
                        {{ isset($SingleContent) ? $SingleContent->content_text : '<p>Lets <strong>start</strong> writing</p>' }}
                        </textarea><!-- End TinyMCE Editor -->
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection



{{-- 
       <div class="form-group">
         <label for="post_content">Post Name</label>
         <input type="email" class="form-control" name="title" id="title" placeholder="Write A suitable Headline for your Content">
       </div>
       <div class="form-group">
         <label for="category">Category</label>
         <select class="form-control" name='category' id="category">
           <option>-- Select --</option>
           @foreach ($categoryOption as $option)
           <option value={{($option->id)}}>{{($option->category_name)}}</option>
           @endforeach
         </select>
       </div> --}}
