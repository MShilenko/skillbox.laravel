@extends('layout')

@section('content')

	@include('layout.errors')
	<form method="POST" action="/tasks">
		@csrf
	  <div class="form-group">
	    <label for="inputTitle">Название задачи</label>
	    <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Введите название задачи">
	  </div>
	  <div class="form-group">
	    <label for="inputBody">Описание задачи</label>
	    <input name="body" type="text" class="form-control" id="inputBody" placeholder="Введите описание задачи">
	  </div>
	  <button type="submit" class="btn btn-primary">Создать задачу</button>
	</form>

@endsection