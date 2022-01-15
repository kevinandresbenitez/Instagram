@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row justify-content-center">
      <div class="col-md-8  showContainer">

        <div class="card showTransition">
            <div class="card-header">{{ __('Crear Publicacion') }}</div>

            <div class="card-body ">
                <form method="POST" action="{{ route('publication-save') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3 ">
                        <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Imagen') }}</label>
                        <div class="col-md-6">
                          <input type="file" accept="image/*" name="img" id="img" class="form-control @error('img') is-invalid @enderror" />

                          @error('img')
                            <span class="invalid-feedback col-md-auto m-auto" role="alert">
                              <strong>'only files are supported : png,jpge,jpg,gif ' </strong>
                            </span>
                          @enderror
                        </div>


                    </div>


                    <div class="row mb-3 ">
                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripcion') }}</label>
                        <div class="col-md-6">
                          <textarea name="description" class="form-control @error('name') is-invalid @enderror" name="description" rows="8" cols="80" id="description"></textarea>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Crear publicacion') }}
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
