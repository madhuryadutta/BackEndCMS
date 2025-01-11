@extends('layouts.main')
@push('title')
<title>Content List</title>

@endpush
@section('main-section')

<div class="bg-body-tertiary p-5 mt-3 rounded">
  <div class="container">
  <div class="container">
    <h1>Manage Contents </h1>
    {{-- <form enctype="multipart/form-data" method="POST" action="{{route('editCategory')}}">
      @csrf
      <div class="form-group">
        <label for="exampleFormControlSelect1">Parent Category</label>
        <select class="form-control" id="exampleFormControlSelect1" name="parentCategory">
          <option value="0">Not applicable</option>
          @foreach ($categoryOption as $option)
          <option value={{($option->id)}}>{{($option->category_name)}}</option>
          @endforeach
          
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Category Name</label>
        <input type="text" class="form-control" name="categoryName" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Active Status</label>
        <select class="form-control" name="is_active" id="exampleFormControlSelect1">
          <option value="1">Active</option>
          <option value="0">Not Active</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">save</button>
    </form> --}}
    <a href="{{route('contentEditor')}}"> <span style="float:right"><button>New Content</button></span></a>
  </div>
  </div>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">sl</th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Last updated at</th>
          <th scope="col">Manage</th>
        </tr>
      </thead>
      <tbody>
        @php
            $i=1
        @endphp
    @foreach ($contents as $content)
        <tr>
          <th scope="row">{{$i}}</th>
          <td>{{($content->title)}}</td>
          <td class="limited-content">{{ $content->content_text }}</td>
          <td>{{($content->status)}}</td>
          <td>{{($content->updated_at)}}</td>
          <td><a href="{{route('singleContent',['id'=>$content->id])}}"><button>Edit</button></a></td>
                  <td><a href="{{route('deleteContent',['id'=>$content->id])}}">
            <button>Delete</button></td>
        </tr>
        @php
        $i++;
        @endphp
        @endforeach
      </tbody>
    </table>  
  </div>
</div>
@endsection