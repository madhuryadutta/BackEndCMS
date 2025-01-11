@extends('layouts.main')
@push('title')
    <title>
        Category List</title>
@endpush
@section('main-section')
    <div class="bg-body-tertiary p-5 mt-3 rounded">
        <div class="container">
            <div class="container">
                <h1>Manage Category </h1>
                <a href="{{ route('newCategory') }}"> <span style="float:right"><button>New Category</button></span></a>
            </div>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">sl</th>
                        <th scope="col">Ctagory Name</th>
                        <th scope="col">Category level</th>
                        <th scope="col">Status</th>
                        <th scope="col">created at</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp

                    @foreach ($categoryList as $category)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $category->category_name }}</td>
                            {{-- <td>{{($category->parent_id)}}</td> --}}
                            <td>
                                @if ($category->parent_id == 0)
                                    Main Category
                                @else
                                    Sub Category
                                @endif
                            </td>
                            <td>{{ $category->is_active }}</td>
                            <td>
                            <td>
                                @if ($category->is_active == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('editCategory', ['id' => $category->id]) }}"><button>Edit</button></a>
                            <td><a href="{{ route('deleteCategory', ['id' => $category->id]) }}">
                                    <button>Delete</button>
                            </td>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
