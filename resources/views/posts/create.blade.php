@extends('layout.master')

@section('title', 'Создать статью')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Создать статью
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('admin.news.create') }}">
		@csrf
		@include('posts.forms.create-and-update', ['post' => new \App\Post(), 'button' => 'Создать статью'])
	</form>

@endsection