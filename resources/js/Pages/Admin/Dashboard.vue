<template>
    <AppLayout>
        <div class="container mt-4">
            <h1>Панель администратора</h1>
            <p>Добро пожаловать, {{ $page.props.auth?.user?.name }}!</p>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Пользователи:</h5>
                            <p class="card-text">Управление пользователями системы:</p>
                            <Link href="/admin/users" class="btn btn-primary">Перейти</Link>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Книги:</h5>
                            <p class="card-text">Управление каталогом книг:</p>
                            <Link href="/books" class="btn btn-primary">Перейти</Link>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Выдачи</h5>
                            <p class="card-text">Журнал выдач книг:</p>
                            <Link href="/loans" class="btn btn-primary">Перейти</Link>
                        </div>
                    </div>
                </div>
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