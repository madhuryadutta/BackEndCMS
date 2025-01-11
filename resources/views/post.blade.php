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
                                <th scope="col">Preview</th>
                                <th scope="col">Post</th>
                                <th scope="col">View Count</th>
                                <th scope="col">Ranking</th>
                                <th scope="col">Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 5; $i++)
                                <tr>
                                    <th scope="row"><a href="#"><img src="assets/img/product-1.jpg"
                                                alt=""></a>
                                    </th>
                                    <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas
                                            nulla</a></td>
                                    <td>64</td>
                                    <td class="fw-bold">124</td>
                                    <td>{{ $i }} abc</td>
                                </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a>
                                </th>
                                <td><a href="#" class="text-primary fw-bold">Exercitationem similique
                                        doloremque</a></td>
                                <td>$46</td>
                                <td class="fw-bold">98</td>
                                <td>$4,508</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a>
                                </th>
                                <td><a href="#" class="text-primary fw-bold">Doloribus nisi
                                        exercitationem</a></td>
                                <td>$59</td>
                                <td class="fw-bold">74</td>
                                <td>$4,366</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a>
                                </th>
                                <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum
                                        error</a></td>
                                <td>$32</td>
                                <td class="fw-bold">63</td>
                                <td>$2,016</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a>
                                </th>
                                <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus
                                        repellendus</a></td>
                                <td>$79</td>
                                <td class="fw-bold">41</td>
                                <td>$3,239</td>
                            </tr>
                            @endfor

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
