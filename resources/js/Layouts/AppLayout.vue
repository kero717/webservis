<template>
    <div>
        <!-- Навигация -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <Link class="navbar-brand" href="/">
                    {{ $page.props.appName ?? 'Библиотека' }}
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <!-- Гость -->
                        <template v-if="!$page.props.auth?.user">
                            <li class="nav-item">
                                <Link class="nav-link" href="/login">Вход</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/register">Регистрация</Link>
                            </li>
                        </template>

                        <!-- Авторизован -->
                        <template v-else>
                            <!-- Админка -->
                            <li v-if="$page.props.auth.user.role === 'admin'" class="nav-item">
                            <Link class="nav-link" href="/admin/dashboard">Админка</Link>
                            </li>

                            <!-- Книги -->
                            <li v-if="['librarian', 'admin'].includes($page.props.auth.user.role)" class="nav-item">
                                <Link class="nav-link" href="/books">Книги</Link>
                            </li>
                            <li v-if="['librarian', 'admin'].includes($page.props.auth.user.role)" class="nav-item">
                                <Link class="nav-link" href="/books/create">Добавить книгу</Link>
                            </li>
                            <li v-else class="nav-item">
                                <Link class="nav-link" href="/books">Каталог книг</Link>
                            </li>

                            <!-- Мои брони (клиент) -->
                            <li v-if="$page.props.auth.user.role === 'client'" class="nav-item">
                                <Link class="nav-link" href="/bookings">Мои брони</Link>
                            </li>

                            <!-- Выдачи и бронирования (библиотекарь/админ) -->
                            <li v-if="['librarian', 'admin'].includes($page.props.auth.user.role)" class="nav-item">
                                <Link class="nav-link" href="/loans">Выдачи</Link>
                            </li>
                            <li v-if="['librarian', 'admin'].includes($page.props.auth.user.role)" class="nav-item">
                                <Link class="nav-link" href="/admin/bookings">Бронирования</Link>
                            </li>

                            <!-- Личный кабинет -->
                            <li class="nav-item">
                                <Link class="nav-link" href="/client/dashboard">Мой кабинет</Link>
                            </li>

                            <!-- Админ: пользователи -->
                            <li v-if="$page.props.auth.user.role === 'admin'" class="nav-item">
                                <Link class="nav-link" href="/admin/users">Пользователи</Link>
                            </li>

                            <!-- Имя и выход (выпадающее меню) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ $page.props.auth.user.name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <Link class="dropdown-item" href="/logout" method="post" as="button">
                                        Выход
                                    </Link>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
};
</script>