@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить пользователя</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Роль</label>
            <select class="form-control" id="role" name="role" required>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Клиент</option>
                <option value="librarian" {{ old('role') == 'librarian' ? 'selected' : '' }}>Библиотекарь</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Администратор</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection