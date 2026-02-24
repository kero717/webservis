@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить книгу</h1>
    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Автор *</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" required>
            @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Жанр</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre') }}">
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Издатель</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Год</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year') }}" min="1800" max="{{ date('Y') }}">
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}">
        </div>
        <div class="mb-3">
            <label for="copies" class="form-label">Количество экземпляров *</label>
            <input type="number" class="form-control @error('copies') is-invalid @enderror" id="copies" name="copies" value="{{ old('copies', 1) }}" required min="1">
            @error('copies') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection