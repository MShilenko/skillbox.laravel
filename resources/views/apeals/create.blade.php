@extends('layout.master')

@section('title', 'Контакты')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Контакты
	</h3>

	<p>Страница контактов.</p>

	@include('layout.errors')

	<form method="POST" action="{{ route('admin.feedbacks') }}">
		@csrf
	  <div class="form-group">
	    <label for="inputEmail">Email</label>
	    <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Введите email" value="{{ old('email') }}">
	  </div>	  	  
	  <div class="form-group">
	    <label for="inputMessage">Сообщение</label>
	    <textarea name="message" class="form-control" id="inputMessage" placeholder="Введите сообщение">{{ old('message') }}</textarea>
	  </div>	  
	  <button type="submit" class="btn btn-primary mt-4">Отправить</button>
	</form>

@endsection