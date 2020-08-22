@extends('layout.master')

@section('title', 'Подтверждение пароля')

@section('content')

  <h3 class="pb-3 mb-4 font-italic border-bottom">
    Подтверждение пароля
  </h3>

  <form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
      <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>
    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
          {{ __('Подтверждение пароля') }}
        </button>
        @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Забыли пароль?') }}
          </a>
        @endif
      </div>
    </div>
  </form>
  
  <hr>

@endsection