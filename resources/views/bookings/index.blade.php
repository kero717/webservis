@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мои бронирования</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
        <p>У вас нет активных бронирований.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Книга</th>
                    <th>Автор</th>
                    <th>Забронировано до</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->book->title }}</td>
                    <td>{{ $booking->book->author }}</td>
                    <td>{{ $booking->expires_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Снять бронь?')">Отменить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection