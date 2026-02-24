@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Журнал выдачи книг</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">Новая выдача</a>

    <table class="table">
        <thead>
            <tr>
                <th>Книга</th>
                <th>Читатель</th>
                <th>Выдана</th>
                <th>Должна быть возвращена</th>
                <th>Возвращена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->loaned_at->format('d.m.Y') }}</td>
                <td>{{ $loan->due_at->format('d.m.Y') }}</td>
                <td>{{ $loan->returned_at ? $loan->returned_at->format('d.m.Y') : 'Не возвращена' }}</td>
                <td>
                    @if(!$loan->returned_at)
                        <form action="{{ route('loans.return', $loan) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Принять</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection