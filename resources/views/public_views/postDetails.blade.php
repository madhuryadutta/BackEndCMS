{{-- @php
echo '<pre>';
    dd($single_content);
die()
@endphp --}}

@extends('layouts.main')
@push('title')
    <title>{{ config('app.name') }}</title>
@endpush
@section('main-section')
    <section class="section dashboard">


        <!-- Top Selling -->
        <div class="col-12">
            <div class="card top-selling overflow-auto">



                <div class="card-body pb-0">
                    {{-- <h5 class="card-title">Post <span>| Today</span></h5> --}}
                    <div class="card">
                        <div class="card-header">{{ $single_content[0]->title }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $single_content[0]->title }}</h5>
                            {!! $single_content[0]->content_text !!}
                        </div>
                        <div class="card-footer">
                            <p>Created at{{ $single_content[0]->created_at }}</p>
                            <p>Created at{{ $single_content[0]->created_at }}</p>
                            <p>Tags at{{ $single_content[0]->content_tags }}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div><!-- End Top Selling -->

        </div>
        </div><!-- End Left side columns -->


        </div>
    </section>
@endsection
