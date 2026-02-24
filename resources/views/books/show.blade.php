@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <dl class="row">
        <dt class="col-sm-3">Автор</dt>
        <dd class="col-sm-9">{{ $book->author }}</dd>
        <dt class="col-sm-3">Жанр</dt>
        <dd class="col-sm-9">{{ $book->genre ?? 'Не указан' }}</dd>
        <dt class="col-sm-3">Издатель</dt>
        <dd class="col-sm-9">{{ $book->publisher ?? 'Не указан' }}</dd>
        <dt class="col-sm-3">Год</dt>
        <dd class="col-sm-9">{{ $book->year ?? 'Не указан' }}</dd>
        <dt class="col-sm-3">ISBN</dt>
        <dd class="col-sm-9">{{ $book->isbn ?? 'Не указан' }}</dd>
        <dt class="col-sm-3">Доступно экземпляров</dt>
        <dd class="col-sm-9">{{ $book->available_copies }} из {{ $book->copies }}</dd>
    </dl>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Назад</a>
    @if(in_array(Auth::user()->role, ['librarian', 'admin']))
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Редактировать</a>
    @endif
    @if(!in_array(Auth::user()->role, ['librarian', 'admin']) && $book->available_copies > 0)
    <form action="{{ route('books.book', $book) }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="btn btn-success" onclick="return confirm('Забронировать книгу?')">Забронировать</button>
    </form>
@endif
</div>
@endsection
