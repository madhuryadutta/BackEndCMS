    <div class="container">
      <form enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Email address</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Example select</label>
          <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect2">Example multiple select</label>
          <select multiple class="form-control" id="exampleFormControlSelect2">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
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
