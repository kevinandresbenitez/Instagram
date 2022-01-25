<div class="row mb-3 position-relative">
    <img onclick="document.getElementById('img').click();" class="img img-fluid border-3 rounded-circle w-25 h-25 m-auto "  src={{ isset(Auth::user()->img) ? route('avatar',['img'=>Auth::user()->img]):route('avatar-default')}} id='Preview-img'>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <input id="img" type="file"  hidden onchange="PreviewImgForm()" class="form-control @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}" accept="image/*"  autocomplete="img" autofocus>
        @error('img')
            <span class="invalid-feedback col-md-auto m-auto text-center" role="alert">
                <strong>{{ $img ?? 'only files are supported : png,jpge,jpg,gif ' }}</strong>
            </span>
        @enderror
    </div>
</div>
