@extends('layout.master')

@section('title', 'Создать новость')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Создать новость
	</h3>

	@include('layout.errors')

	<form method="POST" action="{{ route('main') }}">
		@csrf
		@include('news.forms.create-and-update', ['news' => new \App\Post(), 'button' => 'Создать новость'])
	</form>

@endsection