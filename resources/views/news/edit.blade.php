@extends('layout.master')

@section('title', "Изменить новость '{$news->title}'")

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Изменить новость '{{ $news->title }}'
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('admin.news.update', ['news' => $news]) }}">
		@csrf
		@method('PATCH')
		@include('news.forms.create-and-update', ['button' => 'Изменить новость'])
	</form>

	<hr>

	<form method="POST" action="{{ route('admin.news.destroy', ['news' => $news]) }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger mt-4">Удалить новость</button>
	</form>

	<hr>

@endsection