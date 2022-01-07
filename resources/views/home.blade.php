@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 showContainer">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" >
    <div class="row">

      <div class="col-md-10 offset-1 d-flex align-items-center justify-content-between showContainer ">
        @foreach($publications as $publication)
          {{$publication->users->name}}
          {{$publication->description}}

          <div class="col col-md-3 position-relative">
            <img class="img-fluid" src={{asset('/images/Publications/'.$publication->img)}} alt="Card image cap">
            <div class="d-500 position-absolute top-0 ">Titulo</div>
          </div>

          @if($publication->comments)
            @foreach($publication->comments as $comment)
              {{$comment->description}}
            @endforeach
          @endif

        @endforeach
      </div>

</div>


@endsection
