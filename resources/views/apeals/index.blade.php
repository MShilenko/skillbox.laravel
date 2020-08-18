@extends('layout.master')

@section('title', 'Список обращений')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Список обращений
	</h3>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">Email</th>
				<th scope="col">Сообщение</th>
				<th scope="col">Дата получения</th>
			</tr>
		</thead>
		<tbody>
			@foreach($appeals as $appeal)
				<tr>
					<td>{{ $appeal->email }}</td>
					<td>{{ $appeal->message }}</td>
					<td>{{ $appeal->created_at }}</td>
				</tr>
			@endforeach
		</tbody>	
	</table>
	
@endsection