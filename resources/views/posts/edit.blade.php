@extends('layout.master')

@section('title', "Изменить статью '{$post->title}'")

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Изменить статью '{{ $post->title }}'
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('posts.show', ['post' => $post]) }}">
		@csrf
		@method('PATCH')
	  <div class="form-group">
	    <label for="inputTitle">Название статьи</label>
	    <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Введите название статьи" value="{{ old('title') ?? $post->title }}">
	  </div>	  
	  <div class="form-group">
	    <label for="inputSlug">Символьный код</label>
	    <input name="slug" type="text" class="form-control" id="inputSlug" placeholder="Введите символьный код" value="{{ old('slug') ?? $post->slug }}">
	  </div>
	  <div class="form-group">
	    <label for="inputExcerpt">Краткое описание статьи</label>
	    <textarea name="excerpt" class="form-control" id="inputExcerpt" placeholder="Введите краткое описание статьи">{{ old('excerpt') ?? $post->excerpt }}</textarea>
	  </div>	  
	  <div class="form-group">
	    <label for="inputText">Детальное описание</label>
	    <textarea name="text" class="form-control" id="inputText" placeholder="Введите детальное описание">{{ old('text') ?? $post->text }}</textarea>
	  </div>	  
	  <div class="form-group">
	    <label for="inputTags">Теги</label>
	    <input name="tags" type="text" class="form-control" id="inputTags" placeholder="Добавьте теги" value="{{ old('tags') ?? $post->tags->pluck('name')->implode(', ') }}">
	  </div>
		<div class="form-check">
	    <input name="public" type="checkbox" class="form-check-input" id="publicCheck" value="{{ old('public') ?? $post->public }}" {{ $post->public || old('public') ? ' checked' : '' }}>
	    <label class="form-check-label" for="publicCheck">Опубликовано</label>
	  </div>
	  <button type="submit" class="btn btn-primary mt-4">Изменить статью</button>
	</form>

	<hr>

	<form method="POST" action="{{ route('posts.show', ['post' => $post]) }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger mt-4">Удалить статью</button>
	</form>

	<hr>

@endsection