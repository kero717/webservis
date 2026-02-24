@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Каталог книг</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(in_array(Auth::user()->role, ['librarian', 'admin']))
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Добавить книгу</a>
    @endif

    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Автор: {{ $book->author }}</p>
                        <p class="card-text">Жанр: {{ $book->genre ?? 'Не указан' }}</p>
                        <p class="card-text">Доступно: {{ $book->available_copies }} из {{ $book->copies }}</p>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">Подробнее</a>
                        @if(in_array(Auth::user()->role, ['librarian', 'admin']))
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Редактировать</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить книгу?')">Удалить</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection