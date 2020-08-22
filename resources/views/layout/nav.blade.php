<div class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex justify-content-between">
    <a class="p-2 text-muted" href="{{ route('main') }}">Главная</a>
    <a class="p-2 text-muted" href="{{ route('about') }}">О нас</a>
    <a class="p-2 text-muted" href="{{ route('contacts') }}">Контакты</a>
    @auth
	    <a class="p-2 text-muted" href="{{ route('posts.create') }}">Создать статью</a>
	    <a class="p-2 text-muted" href="{{ route('admin.feedbacks') }}">Админ</a>
	  @endauth  
  </nav>
</div>