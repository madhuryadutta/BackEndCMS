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
                    <h5 class="card-title">Post <span>| Today</span></h5>

                    <table class="table table-borderless">
                        <thead>

                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Preview</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">View Count & Ranking</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Last updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($contents as $content)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <th scope="row"><a href="{{ route('singleContent', ['id' => $content->id]) }}"><img
                                                src="assets/img/product-1.jpg" alt=""></a>
                                    </th>
                                    <td><a href="{{ route('editContent', ['id' => $content->id]) }}"
                                            class="text-primary fw-bold">{{ $content->title }}</a></td>
                                    <td class="limited-content"><a
                                            href="{{ route('editContent', ['id' => $content->id]) }}">{!! $content->content_text !!}</a>
                                    </td>
                                    <td>64</td>
                                    <td class="fw-bold">124</td>
                                    <td>{{ $i }} abc</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Top Selling -->

        </div>
        </div><!-- End Left side columns -->


        </div>
    </section>
@endsection
