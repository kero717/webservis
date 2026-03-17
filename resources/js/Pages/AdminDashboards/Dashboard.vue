<template>
    <AppLayout>
        <div class="container">
            <h1>Панель администратора</h1>
            <p>Добро пожаловать, {{ $page.props.auth?user.name }}!</p>
            <div class="list-group">
                <Link :href="route('admin.users.index')" class="list-group-item list-group-item-action">Управление пользователями</Link>
                <Link :href="route('books.index')" class="list-group-item list-group-item-action">Книги</Link>
                <Link :href="route('loans.index')" class="list-group-item list-group-item-action">Выдачи</Link>
                <Link :href="route('admin.bookings')" class="list-group-item list-group-item-action">Бронирования</Link>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
};
</script>
