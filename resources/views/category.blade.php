@extends('layouts.main')
@push('title')
    <title>{{ config('app.name') }}</title>
@endpush
@section('main-section')
    <section class="section dashboard">




        <div class="col-12">
            <div class="card recent-sales overflow-auto">



                <div class="card-body">
                    <h5 class="card-title">Category <span>| Today</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Category name</th>
                                <th scope="col">Category level</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Ranking</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($categoryList as $category)
                                <tr>
                                    <th scope="row"><a href="#">#{{ $i }}</a></th>
                                    <td><a href="{{ route('editCategory', ['id' => $category->id]) }}"
                                            class="text-primary">{{ $category->category_name }} </a>
                                    </td>
                                    <td>
                                        @if ($category->parent_id == 0)
                                            Main Category
                                        @else
                                            Sub Category
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>#{{ $i }}</td>
                                    <td><span class="badge bg-success">
                                            @if ($category->is_active == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>




        </div>
    </section>
@endsection
