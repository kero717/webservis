@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Панель администратора</h1>
    <p>Добро пожаловать, {{ Auth::user()->name }}!</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Книги</a>
    <a href="#" class="btn btn-secondary">Управление пользователями (скоро)</a>
</div>
@endsection
