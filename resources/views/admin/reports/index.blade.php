@extends('layout.master')

@section('title', 'Админка')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Получить отчет
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('admin.reports') }}">
		@csrf
		<div class="form-check">
		  <input name="models[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Post" {{ old('Post') ? ' checked' : '' }}>
		  <label class="form-check-label" for="inlineCheckbox1">Статьи</label>
		</div>
		<div class="form-check">
		  <input name="models[]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="News" {{ old('News') ? ' checked' : '' }}>
		  <label class="form-check-label" for="inlineCheckbox2">Новости</label>
		</div>
		<div class="form-check">
		  <input name="models[]" class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Comment" {{ old('Comment') ? ' checked' : '' }}>
		  <label class="form-check-label" for="inlineCheckbox3">Комментарии</label>
		</div>
		<div class="form-check">
		  <input name="models[]" class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Tag" {{ old('Tag') ? ' checked' : '' }}>
		  <label class="form-check-label" for="inlineCheckbox4">Теги</label>
		</div>
		<div class="form-check">
		  <input name="models[]" class="form-check-input" type="checkbox" id="inlineCheckbox4" value="User" {{ old('User') ? ' checked' : '' }}>
		  <label class="form-check-label" for="inlineCheckbox4">Пользователи</label>
		</div>
		<button type="submit" class="btn btn-primary mt-4">Отправить</button>
	</form>

@endsection