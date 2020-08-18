<!DOCTYPE html>
<html>
<head>
	<title>Список задач</title>
</head>
<body>
	<h1>Список задач</h1>

	<ul>
	    @foreach ($tasks as $task)
	        <li><a href="/tasks/{{ $task->id }}">{{ $task->title }}</a></li>
	    @endforeach
	</ul>
</body>
</html>


