@extends('layout.master')

@section('title', 'Статистика')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">Статистика</h3>

	<table class="table">
	  <tbody>
	    <tr>
	      <th scope="row">Общее количество статей</th>
	      <td>{{ $statistics['posts_count'] }}</td>
	    </tr>
	    <tr>
	      <th scope="row">Общее количество новостей</th>
	      <td>{{ $statistics['news_count'] }}</td>
	    </tr>
	    <tr>
	      <th scope="row">ФИО автора, у которого больше всего статей на сайте</th>
	      <td>{{ $statistics['best_author']->name }}</td>
	    </tr>
	    <tr>
	      <th scope="row">Самая длинная статья</th>
	      <td><a href="{{ route('posts.show', ['post' => $statistics['longest_post']->slug]) }}">{{ $statistics['longest_post']->title }}</a> | {{ $statistics['longest_post']->textLength }}</td>
	    <tr>
	      <th scope="row">Самая короткая статья</th>
	      <td><a href="{{ route('posts.show', ['post' => $statistics['shortest_post']->slug]) }}">{{ $statistics['shortest_post']->title }}</a> | {{ $statistics['shortest_post']->textLength }}</td>
	    <tr>
	      <th scope="row">Средние количество статей у “активных” пользователей</th>
	      <td>{{ $statistics['avg_amount_posts'] }}</td>
	    <tr>
	      <th scope="row">Самая непостоянная статья</th>
	      <td><a href="{{ route('posts.show', ['post' => $statistics['biggest_history_post']->slug]) }}">{{ $statistics['biggest_history_post']->title }}</a></td>
	    <tr>
	      <th scope="row">Самая обсуждаемая статья</th>
	      <td><a href="{{ route('posts.show', ['post' => $statistics['most_commented_post']->slug]) }}">{{ $statistics['most_commented_post']->title }}</a></td>
	  </tbody>
	</table>

	<nav class="blog-pagination">
	  <a class="btn btn-outline-primary" href="{{ route('main') }}">Вернуться на главную</a>
	</nav>

@endsection