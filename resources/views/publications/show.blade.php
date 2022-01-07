@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">

      <div class="col-md-10 offset-1 d-flex align-items-center justify-content-between showContainer ">
        @foreach($publications as $publication)

          <div class="col col-md-3 position-relative">
            <img class="img-fluid" src={{asset('/images/Publications/10.png')}} alt="Card image cap">
            <div class="d-500 position-absolute top-0 ">Titulo</div>
          </div>
        @endforeach
      </div>

</div>
@endsection
