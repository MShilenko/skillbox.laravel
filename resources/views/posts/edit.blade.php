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
		@include('posts.forms.create-and-update', ['button' => 'Изменить статью'])
	</form>

	<hr>

	<form method="POST" action="{{ route('posts.show', ['post' => $post]) }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger mt-4">Удалить статью</button>
	</form>

	<hr>

@endsection