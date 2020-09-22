@extends('layout.master')

@section('title', 'Админка')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Админка
	</h3>

	<ul>
		<li><a href="{{ route('admin.posts.index') }}">Статьи</a></li>
		<li><a href="{{ route('admin.feedbacks') }}">Обращения</a></li>
	</ul>

@endsection