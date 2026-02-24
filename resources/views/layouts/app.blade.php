<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @php
        $routeName = request()->route() ? request()->route()->getName() : '';
        $uri = request()->path(); // например, '' для главной, 'login' и т.д.
        $excludedRoutes = ['login', 'register', 'password.request', 'password.reset', 'dashboard'];
        $excludedUris = ['', 'login', 'register']; // пустая строка для главной страницы
        $useVue = !in_array($routeName, $excludedRoutes) && !in_array($uri, $excludedUris);
    @endphp
</head>
<body>
    {{-- Контейнер для Vue только там, где он нужен --}}
    @if($useVue)
        <div id="app">
    @endif

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Ссылки для авторизованных пользователей в зависимости от роли --}}
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Админка</a>
                                </li>
                            @endif
                            
                            {{-- Книги: для библиотекаря/админа показываем управление, для клиента — каталог --}}
                            @if(in_array(Auth::user()->role, ['librarian', 'admin']))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books.index') }}">Книги</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books.create') }}">Добавить книгу</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books.index') }}">Каталог книг</a>
                                </li>
                            @endif

                            {{-- Мои брони (доступно всем авторизованным, но имеет смысл только для клиента) --}}
                            @if(Auth::user()->role === 'client')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bookings.index') }}">Мои брони</a>
                                </li>
                            @endif

                            {{-- Выдачи и бронирования (только для библиотекаря и админа) --}}
                            @if(in_array(Auth::user()->role, ['librarian', 'admin']))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('loans.index') }}">Выдачи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('loans.admin.bookings') }}">Бронирования</a>
                                </li>
                            @endif

                            {{-- Личный кабинет (доступен всем) --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.dashboard') }}">Мой кабинет</a>
                            </li>

                            {{-- Управление пользователями (только для админа) --}}
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи</a>
                                </li>
                            @endif

                            {{-- Выпадающее меню с именем и выходом --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    @if($useVue)
        </div> {{-- закрываем div id="app" --}}
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>