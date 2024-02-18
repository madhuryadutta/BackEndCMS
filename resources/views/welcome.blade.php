@extends('layouts.main')
@push('title')
<title>{{config('app.name')}}</title>

@endpush
@section('main-section')
<div class="bg-body-tertiary p-5 rounded">
  <h1>Navbar example</h1>
  <p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll,
    this navbar remains in its original position and moves with the rest of the page.</p>
  <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">View navbar docs &raquo;</a>
</div>
<div class="container">

  <div class="container">
    @foreach ($contents as $content)
    <div class="container-fluid">
    <strong >{{$content->title}}</strong>
  </div>
    <small>Posted on {{$content->created_at}}</small>
    <div class="container">
      <div class="row" style="color: black; font-family: sans-serif;">{!!html_entity_decode($content->content_text)!!}</div>
    </div>

    <h6>This Post was last modified on {{$content->updated_at}}</h6>
    <br>

    <hr>
    @endforeach
  </div>

</div>



@endsection