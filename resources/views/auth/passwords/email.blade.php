@extends('layout.without_sidebar')

@section('title', 'Сбросить пароль')

@section('content')

    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Сбросить пароль
    </h3>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Получить ссылку') }}
                </button>
            </div>
        </div>
    </form>

    <hr>

@endsection
