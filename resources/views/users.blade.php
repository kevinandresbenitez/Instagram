@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row ">

      <div class="col-12 col-md-8 offset-md-2  showContainer">
 
        <!--- shearch user--->        
        <form class='form col-12 col-md-10 offset-md-1 d-flex' action={{route('users')}} method="get" id='Buscador'>
            @csrf()

            <div class='col-8'>
                <input class='form-control ' placeholder='Buscar usuarios' type="text" id='name' name='name'>
            </div>

            <div class='col-auto'>
                <input class='btn btn-white form-control ' type='submit' value='Buscar'  id='ButonSearch' />
            </div>
        </form>

        <!--- function to search users--->        
        <script>
            document.getElementById('ButonSearch').addEventListener('click',(e)=>{
                e.preventDefault();
                let buscador=document.getElementById('Buscador');
                let url =buscador.getAttribute('action')+'/'+document.getElementById('name').value;                
                buscador.setAttribute('action',url);
                buscador.submit();
            })
        </script>

        <!--- if not have users--->
        @foreach($users as $user)            
            <div class='row m-auto'>
            
                <div class="col-12 col-md-6 d-flex my-4 justify-content-center justify-content-md-end align-items-center">
                    <img class='img-fluid rounded-circle' style='max-width:300px;max-height:300px;width:100%;height:100%' src={{$user->img ? route('avatar',['img'=> $user->img]):route('avatar-default') }}  />                
                </div>

                <div class="col-12 col-md-6  d-flex flex-column justify-content-center  align-items-center align-items-md-end py-md-5  overflow-hidden">
                    <a class='mx-2 my-0 h3' href={{route('profile',['id'=> $user->id])}} >{{'@'.$user->name}}</a>
                    <p class='h3'>Publicaciones:{{count($user->publications)}}</p>
                    <p class='h3'>Se unio hace {{FormatTime::LongTimeFilter($user->created_at)}}</p>
                    <p class='h3'>{{$user->email}}</p>                    
                </div>

            </div>

            <!--- Separator --->
            <div class="col-12 my-5">
                <hr class='m-auto w-95'>
            </div>

        @endforeach



          <!--- Pagination--->
          <div class="col-12 d-flex justify-content-center align-items-center">
            {{$users->links('pagination::bootstrap-4')}}
          </div>
      </div>

      
      <!--- Container Notification --->
      @include('includes.toastNotification')
      <!--- Container Modals --->
      @include('includes.modalBoostrap')
</div>


@endsection
