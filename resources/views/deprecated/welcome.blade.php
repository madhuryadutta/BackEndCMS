@extends('layouts.main')
@push('title')
    <title>{{ config('app.name') }}</title>
@endpush
@section('main-section')
    <style>
        img.my-responsive-image {
            width: 100% !important;
            height: auto !important;
        }
    </style>
    <div class="bg-body-tertiary p-5 rounded">
        <h1>Navbar example</h1>
        <p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll,
            this navbar remains in its original position and moves with the rest of the page.</p>
        <a class="btn btn-lg btn-primary" href="../components/navbar/" role="button">View navbar docs &raquo;</a>
    </div>
    <div class="container">

        <div class="container">
            @foreach ($contents as $content)
                {{-- method 2 --}}
                {{-- @php
    $final= $content->title .$content->content_text;
    @endphp --}}
                {{-- method 2 --}}
                <div class="container-fluid">
                    {{-- <strong>{{$content->title}}</strong> --}}
                    {{-- <h2>{{$content->title}}</h2> --}}
                </div>
                <small>Posted on {{ $content->created_at }}</small>
                @php
                    $decodedString = str_replace('\n', '&lt;br&gt;', $content->content_text);
                    //  $decodedString =  str_replace('\"', '', $decodedString);
                @endphp
                <div class="container">
                    {{-- <div class="row" style="color: black; font-family: sans-serif;">{!!html_entity_decode($final)!!}</div> --}}
                    <div class="row" style="color: black; font-family: sans-serif;">{!! html_entity_decode(
                        '<h1
                              style="color: tomato;font-style: oblique;font-family: cursive;">' .
                            $content->title .
                            '</h1><br><br>' .
                            $decodedString,
                    ) !!}</span></div>
                </div>


                <h6>This Post was last modified on {{ $content->updated_at }}</h6>
                <br>

                <hr>
            @endforeach
        </div>

    </div>
@endsection
