@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Панель управления</h1>
    <p>Добро пожаловать, {{ Auth::user()->name }} (роль: {{ Auth::user()->role }})</p>

    <div class="list-group">
        <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action">📚 Каталог книг</a>

        @if(Auth::user()->role === 'client')
            <a href="{{ route('bookings.index') }}" class="list-group-item list-group-item-action">📌 Мои бронирования</a>
        @endif

        @if(in_array(Auth::user()->role, ['librarian', 'admin']))
            <a href="{{ route('books.create') }}" class="list-group-item list-group-item-action">➕ Добавить книгу</a>
        @endif

        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">👥 Управление пользователями</a>
        @endif
    </div>
</div>
@endsection