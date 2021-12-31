@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  showTransition">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body showTransition ">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="row mb-3 ">
                            <img class="img img-fluid border-3 rounded-circle w-25 h-25 m-auto " src={{asset('images/UserImgDefault/UserDefault.png')}} id='Preview-img'>
                        </div>


                        <div class="row mb-3">
                            <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Img') }}</label>
                            <div class="col-md-6">
                                <input id="img" type="file"  onchange="show()" class="form-control @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}" accept="image/*"  autocomplete="img" autofocus>
                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $img ?? 'only files are supported : png,jpge,jpg,gif ' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <script type="text/javascript">
                          function show(){
                            let file = document.getElementById('img').files[0];
                            let preview = document.getElementById('Preview-img');

                            if(file.type != "image/png"){
                              return false;
                            }

                            var reader  = new FileReader();
                            reader.onloadend = function () {
                              preview.src = reader.result;
                            }
                            if (file) {
                              reader.readAsDataURL(file);
                            } else {
                              preview.src = "";
                            }



                          }
                        </script>



                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
