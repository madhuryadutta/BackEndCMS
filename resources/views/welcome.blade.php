@extends('layouts.main')
@push('title')
<title>Hit-O-Meter</title>

@endpush
@section('main-section')
    <div class="container">
        <h1>Hello, world!</h1>
        <div class="container">
            @foreach ($trackers as $tracker)
            {{-- <div class="container">{{$tracker->content_text}}</div> --}}
            <div class="row">{!!html_entity_decode($tracker->content_text)!!}</div>
            <hr>
            @endforeach
        </div>

    </div>



    @endsection