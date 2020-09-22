@if(session()->has('message'))
	<div class="alert alert-{{ session('type') }} mt-4">
		{{ session('message') }}
	</div>
@endif