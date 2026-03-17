<template>
    <AppLayout>
        <div class="container mt-5 text-center">
            <h1 class="display-4">📚 Добро пожаловать в библиотеку!</h1>
            <p class="lead" v-if="$page.props.auth?.user">
                Вы вошли как <strong>{{ $page.props.auth.user.name }}</strong>.
                <span v-if="$page.props.auth.user.role === 'admin'" class="badge bg-danger ms-2">Администратор</span>
                <span v-else-if="$page.props.auth.user.role === 'librarian'" class="badge bg-warning ms-2">Библиотекарь</span>
                <span v-else class="badge bg-info ms-2">Клиент</span>
            </p>
            <div class="mt-4">
                <template v-if="$page.props.auth?.user">
                    <!-- Ссылки для всех авторизованных -->
                    <Link href="/books" class="btn btn-primary btn-lg me-2 mb-2">
                        <i class="fas fa-book"></i> Каталог книг
                    </Link>
                    
                    <!-- Для клиента -->
                    <Link v-if="$page.props.auth.user.role === 'client'" href="/bookings" class="btn btn-info btn-lg me-2 mb-2">
                        <i class="fas fa-calendar-alt"></i> Мои брони
                    </Link>
                    
                    <!-- Для библиотекаря и админа -->
                    <Link v-if="['librarian', 'admin'].includes($page.props.auth.user.role)" href="/loans" class="btn btn-success btn-lg me-2 mb-2">
                        <i class="fas fa-hand-holding"></i> Выдачи
                    </Link>
                    
                    <!-- Для админа -->
                    <Link v-if="$page.props.auth.user.role === 'admin'" href="/admin/dashboard" class="btn btn-danger btn-lg me-2 mb-2">
                        <i class="fas fa-crown"></i> Админка
                    </Link>
                    
                    <!-- Для всех -->
                    <Link href="/client/dashboard" class="btn btn-secondary btn-lg me-2 mb-2">
                        <i class="fas fa-user"></i> Мой кабинет
                    </Link>
                    
                    <!-- Кнопка выхода -->
                    <button @click="logout" class="btn btn-dark btn-lg mb-2">
                        <i class="fas fa-sign-out-alt"></i> Выйти
                    </button>
                </template>
                <template v-else>
                    <Link href="/login" class="btn btn-primary btn-lg me-2">Войти</Link>
                    <Link href="/register" class="btn btn-outline-primary btn-lg">Регистрация</Link>
                </template>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    props: {
        laravelVersion: String,
        phpVersion: String,
    },
    methods: {
        logout() {
            router.post('/logout');
        }
    }
};
</script>