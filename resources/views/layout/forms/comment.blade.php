@auth
	<hr>

	<h2>Оставить комментарий</h2>

	@include('layout.errors')

	<form method="POST" action="{{ route($route, $post) }}">
		@csrf
		<div class="form-group">
		  <label for="inputText">Комментарий</label>
		  <textarea name="text" class="form-control" id="inputText" placeholder="Введите детальное описание">{{ old('text') }}</textarea>
		</div>
		<button type="submit" class="btn btn-primary mt-4">Добавить</button>
	</form>
@endauth