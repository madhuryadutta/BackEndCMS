@extends('layouts.main')
@push('title')
<title>Hit-O-Meter</title>

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
            @foreach ($trackers as $tracker)
            {{-- <div class="container">{{$tracker->content_text}}</div> --}}
            <div class="row" style="color: black; font-family: sans-serif;" >{!!html_entity_decode($tracker->content_text)!!}</div>
            <hr>
            @endforeach
        </div>

    </div>



    @endsection