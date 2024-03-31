@extends('layouts.main')
@push('title')
<title>{{config('app.name')}}</title>

@endpush
@section('main-section')
<br>
<br>
<br>
<br>


  <div class="container text-center ">
    <div class="row">
      <div class="col">
        <div class="card" style="width: 18rem;">
          <img src="https://databytedigital.com/image/logo.png" class="card-img-top" alt="https://databytedigital.com/image/logo.png">
          <div class="card-body">
            <h5 class="card-title">Categories</h5>
            <p class="card-text">Manage all category related task from here.</p>
            <a href="{{route('viewCategory')}}" class="btn btn-primary">Open</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card" style="width: 18rem;">
          <img src="https://databytedigital.com/image/logo.png" class="card-img-top" alt="https://databytedigital.com/image/logo.png">
          <div class="card-body">
            <h5 class="card-title">Post</h5>
            <p class="card-text">Manage all Content related task from here..</p>
            <a href="{{route('listContent')}}" class="btn btn-primary">Open</a>
          </div>
        </div>
      </div>
      {{-- <div class="col">
        <div class="card" style="width: 18rem;">
          <img src="https://databytedigital.com/image/logo.png" class="card-img-top" alt="https://databytedigital.com/image/logo.png">
          <div class="card-body">
            <h5 class="card-title">Other</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Open</a>
          </div>
        </div>
      </div> --}}
    </div>
  </div>

</div>



@endsection