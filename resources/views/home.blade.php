@extends('layouts.app')

@section('content')
<!---
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
</div> !--->



<div class="container" >
    <div class="row ">

      <div class="col-12 col-md-6 offset-md-1  showContainer ">
          <!--- Items--->
          @foreach($publications as $publication)
          <div class="col-12 col-md-12  mb-5 bg-white">

              <div class="col-12 d-flex p-1">
                <!--- Left item header--->
                <div class="col-6 col-md-3 d-flex align-items-center">
                  <img class="img-fluid m-auto rounded-circle d-block" style="width:45px;height:45px" src={{asset('/images/UserImgProfile/'.$publication->users->img)}} alt={{$publication->users->name}}>
                  <p class="lead m-auto mx-2">{{$publication->users->name}}</p>
                </div>

                <!--- right item header--->
                <div class="col-6 col-md-9 d-flex justify-content-end align-items-center">
                  <span class="mx-2 my-auto">{{FormatTime::LongTimeFilter($publication->created_at)}}</span>
                </div>
              </div>

                <!--- Img items--->
              <div class="col-12 ">
                <img class="img-fluid m-auto d-block w-100 h-100" src={{asset('/images/Publications/'.$publication->img)}} alt="Card image cap">
              </div>

              <!--- Nav publication--->
              <div class="col-12 bg-white p-2 ">

                <!--- Comments icon--->
                @if(count($publication->comments) > 0)
                  <button type="button" class="btn m-1 p-1" onclick="showComments(this)">
                      <img  class="icons-publication"src={{asset('icons/comments/comment-regular.svg')}} alt="Add comment">
                  </button>
                @endif

                <!-- If publications dont have likes , show button to add ,if have likes , verify if user session send like ,show button to remove or add -->
                @if(count($publication->likes) > 0)
                  @for($sec = 0;count($publication->likes) >= $sec;)
                      @if(isset($publication->likes[$sec]) && $publication->likes[$sec]->user_id == Auth::user()->id)
                          <a class="btn m-1 p-1" href={{route('like-remove',['publication'=>$publication->id])}}>
                            <img  class="icons-publication" src={{asset('icons/likes/heart-solid.svg')}} alt="">
                          </a>
                          @break
                      @elseif($sec == count($publication->likes))
                      <a  class="btn m-1 p-1" href={{route('like-add',['publication'=>$publication->id])}}>
                        <img class="icons-publication" src={{asset('icons/likes/heart-regular.svg')}} alt="">
                      </a>
                      @endif
                      @php
                        $sec ++;
                      @endphp
                  @endfor
                @else
                <a  class="btn m-1 p-1" href={{route('like-add',['publication'=>$publication->id])}}>
                  <img class="icons-publication" src={{asset('icons/likes/heart-regular.svg')}} alt="">
                </a>
                @endif

                  Likes:
                  {{count($publication->likes)}}
                  Comentarios:
                  {{count($publication->comments)}}

              </div>


              <!--- Description--->
              @if($publication->description)
                <div class="col-12 bg-white p-2 border-bottom">
                  <p>{{$publication->description}}</p>
                </div>
              @endif

              <!--- Comments--->
              @if($publication->comments)
                <div class="col-12 bg-white p-2 d-none">
                    @foreach($publication->comments as $comment)
                        <!--- Header Comment--->
                      <div class="col-12 ">
                        <!--- Header left--->
                        <div class="col-12 d-flex  align-items-center ">
                          <img class="img-fluid rounded-circle d-block my mx-2" style="width:45px;height:45px" src={{ $comment->users->img ? asset('/images/UserImgProfile/'.$comment->users->img):asset('/images/UserImgDefault/UserDefault.png')}} alt={{$publication->users->name}}>
                          <p class="my-auto mx-2 ">{{$comment->users->name}}</p>
                          <p class="mx-0 my-auto">|</p>                      
                          <p class="mx-2 my-auto">{{FormatTime::LongTimeFilter($comment->created_at)}}</p>
                        </div>
                      </div>

                      <!---Comments description--->
                      <div class="col-12 p-2">
                        <p>{{$comment->description}}</p>
                      </div>
                    @endforeach
                  </div>
              @endif

              <!---Add a comment--->
              <div class="col-12 bg-white p-2">
                <form class="form" action={{route('comment-add',['publication'=>$publication->id])}} method="post">
                  @csrf
                  <div class="input-group">
                    <input class="form-control" name="description" type="text" name="comment" placeholder="Add a comment" required>
                    <input type="submit" hidden name="" value="">
                    <button type="button" class="btn m-1 p-1" name="button" onclick="sendFormComments(this)">
                      <img  class="icons-publication"src={{asset('icons/comments/paper-plane-regular.svg')}} alt="Add comment">
                    </button>
                  </div>
                </form>
              </div>

          </div>
          @endforeach

          <!--- Pagination--->
          <div class="col-12 d-flex justify-content-center align-items-center">
            {{$publications->links('pagination::bootstrap-4')}}
          </div>
      </div>

      <!--- Aside--->
      <div class="col-12 col-md-5 showContainer d-none d-md-block ">
        <div class="col-12 bg-white position-sticky p-3 " style="top:28px">
          Este es el aside
        </div>
      </div>

</div>


@endsection
