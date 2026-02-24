@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Новая выдача</h1>
    <form method="POST" action="{{ route('loans.store') }}">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Читатель</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">-- Выберите читателя --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="book_id" class="form-label">Книга</label>
            <select class="form-control" id="book_id" name="book_id" required>
                <option value="">-- Выберите книгу --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->author }}) – доступно {{ $book->available_copies }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="booking_id" class="form-label">Или выберите бронь (необязательно)</label>
            <select class="form-control" id="booking_id" name="booking_id">
                <option value="">-- Без брони --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->user->name }} – {{ $booking->book->title }} (до {{ $booking->expires_at->format('d.m.Y H:i') }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Выдать</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Отмена</a>
    </form>

    {{-- Скрипт для автоматического выбора, если передан selectedBooking --}}
    @if(isset($selectedBooking) && $selectedBooking)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Выбираем читателя
            var userSelect = document.getElementById('user_id');
            for(var i = 0; i < userSelect.options.length; i++) {
                if(userSelect.options[i].value == '{{ $selectedBooking->user_id }}') {
                    userSelect.selectedIndex = i;
                    break;
                }
            }
            // Выбираем книгу
            var bookSelect = document.getElementById('book_id');
            for(var i = 0; i < bookSelect.options.length; i++) {
                if(bookSelect.options[i].value == '{{ $selectedBooking->book_id }}') {
                    bookSelect.selectedIndex = i;
                    break;
                }
            }
            // Выбираем бронь в выпадающем списке (если нужно)
            var bookingSelect = document.getElementById('booking_id');
            for(var i = 0; i < bookingSelect.options.length; i++) {
                if(bookingSelect.options[i].value == '{{ $selectedBooking->id }}') {
                    bookingSelect.selectedIndex = i;
                    break;
                }
            }
        });
    </script>
    @endif
</div>
@endsection