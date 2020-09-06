@auth
	<hr>

	<h2>Оставить комментарий</h2>

	@include('layout.errors')

	<form method="POST" action="{{ route('comments.store') }}">
		@csrf
		<input type="hidden" name="model" value="{{ $model }}">
		<input type="hidden" name="id" value="{{ $id }}">
		<div class="form-group">
		  <label for="inputText">Комментарий</label>
		  <textarea name="text" class="form-control" id="inputText" placeholder="Введите детальное описание">{{ old('text') }}</textarea>
		</div>
		<button type="submit" class="btn btn-primary mt-4">Добавить</button>
	</form>
@endauth