<hr>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Пользователь</th>
      <th scope="col">Комментарий</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
      <tr>
        <th scope="row">{{ $comment->user->name }}</th>
        <td>{{ $comment->text }}</td>
      </tr>
    @endforeach
  </tbody>
</table>