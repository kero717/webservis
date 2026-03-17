<template>
    <AppLayout>
        <h1>Управление пользователями</h1>

        <Link href="/admin/users/create" class="btn btn-primary mb-3">
            Добавить пользователя
        </Link>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td>
                        <Link :href="`/admin/users/${user.id}/edit`" class="btn btn-warning btn-sm">Редактировать</Link>
                        <button @click="deleteUser(user.id)" class="btn btn-danger btn-sm">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    props: {
        users: Array,
    },
    methods: {
        deleteUser(id) {
            if (confirm('Удалить пользователя?')) {
                router.delete(`/admin/users/${id}`);
            }
        }
    }
};
</script>