@extends('layouts.app')
@section('content')

<div class="container" >
    <div class="row ">
      
      <div class="col-12 col-md-6 offset-md-1  showContainer ">
        <h1 class='py-2 px-md-2'>Mis publicaciones favoritas</h1>
          <!--- Publications--->
          @foreach($likes as $like)
            @include('includes.publication.itemPublication',['publication'=>$like->publications])           
          @endforeach
          
          <!--- If not have publications--->
          @if(count($likes) == 0)
            <div class='col bg-white p-3 d-flex align-items-center'>
              <p class='m-0'>No hay publicaciones aun</p>
            </div>
          @endif

          <!--- Pagination--->
          <div class="col-12 d-flex justify-content-center align-items-center">
            {{$likes->links('pagination::bootstrap-4')}}
          </div>
      </div>

      <!--- Aside--->
      <div class="col-12 col-md-5 showContainer d-none d-md-block ">
        <div class="col-12 bg-white position-sticky p-3 " style="top:28px">
          Este es el aside
        </div>
      </div>

      <!--- Container Notification --->
      @include('includes.toastNotification')
      <!--- Container Modals --->
      @include('includes.modalBoostrap')
</div>


@endsection
