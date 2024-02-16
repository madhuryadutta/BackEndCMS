<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1>Hello, world!</h1>
    <div class="container">
        @foreach ($categoryList as $category)
        {{-- <div class="container">{{$tracker->content_text}}</div> --}}
        <div class="row">{!!html_entity_decode($category->category_name)!!}</div>
        <hr>
        @endforeach
    </div>
</div>
</body>
</html>


