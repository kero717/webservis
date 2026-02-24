@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Все бронирования</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->isEmpty())
        <p>Нет активных бронирований.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Книга</th>
                    <th>Автор</th>
                    <th>Пользователь</th>
                    <th>Email</th>
                    <th>Забронировано до</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->book->title }}</td>
                    <td>{{ $booking->book->author }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->user->email }}</td>
                    <td>{{ $booking->expires_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('loans.create', ['booking_id' => $booking->id]) }}" class="btn btn-success btn-sm">Выдать</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection