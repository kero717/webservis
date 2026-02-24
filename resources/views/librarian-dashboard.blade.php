@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Панель библиотекаря</h1>
    <p>Добро пожаловать, {{ Auth::user()->name }}!</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Управление книгами</a>
    <a href="{{ route('loans.index') }}" class="btn btn-secondary">Журнал выдач</a>
</div>
@endsection