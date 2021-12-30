@extends('layouts.app')

@section('content')
  <div class="container" >
      <div class="row justify-content-center">
        <div class="col-md-8 ">


          @if(session('message'))


            <div class="alert alert-light showTransition text-center" role="alert">

              <div class="success-checkmark ">
                <div class="check-icon showTransition">
                  <span class="icon-line line-tip showTransition"></span>
                  <span class="icon-line line-long showTransition"></span>
                  <div class="icon-circle "></div>
                  <div class="icon-fix showTransition"></div>
                </div>
              </div>

              {{session('message')}}
            </div>
          @endif







          <div class="card showTransition">
              <div class="card-header">{{ __('Configuracion') }}</div>

              <div class="card-body ">
                  <form method="POST" action="{{ route('config') }}">
                      @csrf

                      <div class="row mb-3 ">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
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
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
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
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Actualizar Usuarior') }}
                              </button>
                          </div>
                      </div>

                  </form>
              </div>
          </div>


        </div>
      </div>
  </div>
@stop
