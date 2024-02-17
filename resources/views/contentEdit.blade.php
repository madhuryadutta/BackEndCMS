   
   @extends('layouts.main')
   @push('title')
   <title>Hit-O-Meter</title>
   
   @endpush
   @section('main-section')
   
   <div class="container mt-5 ">
      <form enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Post Name</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Write A suitable Headline for your Content">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Example select</label>
          <select class="form-control" id="exampleFormControlSelect1">
            <option>-- Select --</option>
            @foreach ($categoryOption as $option)
            <option value={{($option->id)}}>{{($option->category_name)}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="editor">Example textarea</label>
          <textarea class="form-control" id="editor" name="editor"></textarea>
        </div>
      </form>
      <button onclick="myFunction()">Click me</button>
    </div>
  </div>

  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
  <script>
    // CKEDITOR.replace( 'editor' );
  </script>

  <script>
    CKEDITOR.replace('editor', {
      filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });
  </script>
  <script>
    function myFunction() {
      var data = CKEDITOR.instances.editor.getData();
      $.ajax({
        type: "POST",
        url: "{{route('create_post')}}",
        data: {
          "_token": "{{ csrf_token() }}",
          "post": data,
        },
        dataType: "json",
        success: function(response) {
          console.log(response);
        }
      });
      console.log(data);
    }
  </script>
