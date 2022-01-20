<div class="col-12 col-md-12  mb-5 bg-white">

<!--- Publication header--->   
<div class="col-12 d-flex p-1">
<!--- Left item header--->
<div class="col-6 col-md-3 d-flex align-items-center">
  <img class="img-fluid m-auto rounded-circle d-block" style="width:45px;height:45px" src={{isset($user->img)  ? asset('/images/UserImgProfile/'.$publication->users->img): asset('images/UserImgDefault/UserDefault.png')}} alt={{$publication->users->name}}>
  <p class="lead m-auto mx-2">{{$publication->users->name}}</p>
</div>

<!--- right item header--->
<div class="col-6 col-md-9 d-flex justify-content-end align-items-center">
  <span class="mx-2 my-auto">{{FormatTime::LongTimeFilter($publication->created_at)}}</span>
</div>
</div>

<!--- Img publication--->
<div class="col-12 ">
<img class="img-fluid m-auto d-block w-100 h-100" src={{asset('/images/Publications/'.$publication->img)}} alt="Card image cap">
</div>

<!--- Nav publication--->
<div class="col-12 bg-white p-2 ">

<!--- Comments icon--->
@if(count($publication->comments) > 0)
  <button type="button" class="btn m-1 p-1 shadow-none buttonComment" onclick="showComments(this)">
    <i class="far fa-comment fa-lg"></i>
  </button>
@else
  <button type="button" class="btn m-1 p-1 shadow-none disabled buttonComment" onclick="showComments(this)">
    <i class="far fa-comment fa-lg"></i>
  </button>
@endif
 <!--- Like icon--->
<!-- If publications dont have likes , show button to add ,if have likes , verify if user session send like ,show button to remove or add -->
@if(count($publication->likes) > 0)
  @for($sec = 0;count($publication->likes) >= $sec;)
      @if(isset($publication->likes[$sec]) && $publication->likes[$sec]->user_id == Auth::user()->id)
          <button onclick="removeLike('{{ route('like-remove',['publication'=>$publication->id]) }}','{{ route('like-add',['publication'=>$publication->id]) }}',this)" ,this)" class="btn m-1 p-1 shadow-none">
            <i class="fas fa-heart fa-lg" style='color:red'></i>
          </button>
          @break
      @elseif($sec == count($publication->likes))
          <button  onclick="addLike('{{ route('like-add',['publication'=>$publication->id]) }}','{{ route('like-remove',['publication'=>$publication->id]) }}',this)" class="btn m-1 p-1 shadow-none" >
            <i class="far fa-heart fa-lg" style='color:red'></i>
          </button>
      @endif
      @php
        $sec ++;
      @endphp
  @endfor
@else                
  <button onclick="addLike('{{ route('like-add',['publication'=>$publication->id]) }}','{{ route('like-remove',['publication'=>$publication->id]) }}',this)" class="btn m-1 p-1 shadow-none" >
    <i class="far fa-heart fa-lg" style='color:red'></i>
  </button>
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

<!--- Comments container--->
@if($publication->comments)
<div class="col-12 bg-white p-2 d-none containerComments">
    @foreach($publication->comments as $comment)

      <!--- Comment  --->
    <div class="col-12 ">
        <!--- Header Comment--->
      <div class="col-12 ">
        <!--- Header left--->
        <div class="col-12 d-flex  align-items-center ">
          <img class="img-fluid rounded-circle d-block my mx-2" style="width:45px;height:45px" src={{ $comment->users->img ? asset('/images/UserImgProfile/'.$comment->users->img):asset('/images/UserImgDefault/UserDefault.png')}} alt={{$publication->users->name}}>
          <p class="my-auto mx-2 ">{{$comment->users->name}}</p>
          <p class="mx-0 my-auto">|</p>                      
          <p class="mx-2 my-auto">{{FormatTime::LongTimeFilter($comment->created_at)}}</p>
          @if($comment->user_id == Auth::user()->id)
            <p class="mx-0 my-auto">|</p>  
            <button class='btn btn-sm  border-none bt-white text-primary' onclick=(removeComment('{{route('comment-remove',['publication'=>$comment->id])}}',this)) >Eliminar</button>
          @endif
        </div>
      </div>

      <!---Comments description--->
      <div class="col-12 p-2">
        <p>{{$comment->description}}</p>
      </div>
    </div>
    @endforeach
  </div>
@endif

<!---Add a comment--->
<div class="col-12 bg-white p-2">
  <div class="input-group">                    
    <input class="form-control shadow-none border-0 border-bottom bg-white" name="description" type="text" name="comment" placeholder="Agregar un comentario" required>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <button type="button" class="btn m-1 p-1" name="button" onclick="sendFormComments('{{URL::to('/')}}','{{$publication->id}}',this)">
      <img  class="icons-publication"src={{asset('icons/comments/paper-plane-regular.svg')}} alt="Add comment">
    </button>
  </div>
</div>

</div>