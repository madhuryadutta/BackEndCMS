   
   @extends('layouts.main')
   @push('title')
   <title>Content Editor</title>
   
   @endpush
   @section('main-section')
   
   <div class="container mt-5 ">
      <form enctype="multipart/form-data">
        @csrf
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
        </div>
        <div class="form-group">
          <label for="editor">Content</label>
          <textarea class="form-control" id="editor" name="editor"></textarea>
        </div>
      </form>
      <button onclick="myFunction()">Click me</button>
    </div>
  </div>
  

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
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
        url: "{{route('createContent')}}",
        data: {
          "_token": "{{ csrf_token() }}",
          "post_content": data,
          "title": document.getElementById("title").value,
          "category": document.getElementById("category").value,
        },
        dataType: "json",
        success: function(response) {
          if(response.code==1){
            location.reload();
          }
          else{
            console.log();
          console.log(response);

          console.log(response.status);
          }
        }
      });
      console.log(data);
    }
  </script>
