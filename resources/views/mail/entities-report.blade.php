@component('mail::message')
# Отчет

@foreach ($report as $key => $value)
	Модель: {{ $key }} | Количество элементов: {{ $value }} 
@endforeach

@component('mail::button', [
	'url' => route('admin.reports')
])
Перейти на страницу отчета 
@endcomponent

{{ config('app.name') }}
@endcomponent