@extends('layout.master')

@section('title', 'Создать статью')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Создать статью
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('main') }}">
		@csrf
	  <div class="form-group">
	    <label for="inputTitle">Название статьи</label>
	    <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Введите название статьи" value="{{ old('title') }}">
	  </div>	  
	  <div class="form-group">
	    <label for="inputSlug">Символьный код</label>
	    <input name="slug" type="text" class="form-control" id="inputSlug" placeholder="Введите символьный код" value="{{ old('slug') }}">
	  </div>
	  <div class="form-group">
	    <label for="inputExcerpt">Краткое описание статьи</label>
	    <textarea name="excerpt" class="form-control" id="inputExcerpt" placeholder="Введите краткое описание статьи">{{ old('excerpt') }}</textarea>
	  </div>	  
	  <div class="form-group">
	    <label for="inputText">Детальное описание</label>
	    <textarea name="text" class="form-control" id="inputText" placeholder="Введите детальное описание">{{ old('text') }}</textarea>
	  </div>	  
		<div class="form-check">
	    <input name="public" type="checkbox" class="form-check-input" id="publicCheck" value="1">
	    <label class="form-check-label" for="publicCheck">Опубликовано</label>
	  </div>
	  <button type="submit" class="btn btn-primary mt-4">Создать статью</button>
	</form>

@endsection