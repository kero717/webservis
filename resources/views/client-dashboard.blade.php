@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Личный кабинет читателя</h1>
    <p>Добро пожаловать, {{ Auth::user()->name }}!</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Перейти к каталогу книг</a>
</div>
@endsection