@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Добро пожаловать в библиотеку!</h1>
    @guest
        <p class="lead">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Регистрация</a>
        </p>
    @else
        <p class="lead">Вы вошли как {{ Auth::user()->name }} (роль: {{ Auth::user()->role }})</p>
        <div class="mt-4">
            <a href="{{ route('books.index') }}" class="btn btn-success">Перейти к каталогу книг</a>
            @if(Auth::user()->role === 'client')
                <a href="{{ route('bookings.index') }}" class="btn btn-info">Мои бронирования</a>
            @endif
            @if(in_array(Auth::user()->role, ['librarian', 'admin']))
                <a href="{{ route('books.create') }}" class="btn btn-warning">Добавить книгу</a>
            @endif
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Управление пользователями</a>
            @endif
        </div>
    @endguest
</div>
@endsection