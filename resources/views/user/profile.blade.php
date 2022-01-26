@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="col-12 col-md-8 offset-md-2 ">
        <!--- Principal Info user --->
        <div class='row m-auto'>
            
            <div class="col-12 col-md-6 d-flex my-4 justify-content-center justify-content-md-end align-items-center">
                <img class='img-fluid rounded-circle' style='max-width:300px;max-height:300px;width:100%;height:100%' src={{$user->img ? route('avatar',['img'=> $user->img]):route('avatar-default') }}  />                
            </div>

            <div class="col-12 col-md-6  d-flex flex-column justify-content-center  align-items-center align-items-md-end py-md-5  overflow-hidden">

                <h1 class='h3'>{{$user->name}}</h1>
                <p class='h3'>Publicaciones:{{count($user->publications)}}</p>
                <p class='h3'>Se unio hace {{FormatTime::LongTimeFilter($user->created_at)}}</p>
                <p class='h3'>{{$user->email}}</p>
                
            </div>

        </div>

        <!--- Separator --->
        <div class="col-12 my-5">
            <hr class='m-auto w-95'>
        </div>

        <!--- Publications User --->
        <div class="row ">

            <!--- Publications items--->
            @foreach($user->publications as $publication)
                @include('includes.publication.itemPublication',['publication'=>$publication])           
            @endforeach        

            <!--- If not have publications--->
            @if(count($user->publications) == 0)
                <div class='col bg-white p-3 d-flex align-items-center'>
                <p class='m-0'>No hay publicaciones aun</p>
                </div>
            @endif
            
        </div>

    </div>



    <!--- Container Notification --->
    @include('includes.toastNotification')
    <!--- Container Modals --->
    @include('includes.modalBoostrap')

</div>
@endsection
