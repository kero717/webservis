<template>
    <AppLayout>
        <h1>Редактировать пользователя</h1>
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input v-model="form.name" type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="form.email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Новый пароль (оставьте пустым, если не хотите менять)</label>
                <input v-model="form.password" type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Роль</label>
                <select v-model="form.role" class="form-control" id="role" required>
                    <option value="client">Клиент</option>
                    <option value="librarian">Библиотекарь</option>
                    <option value="admin">Администратор</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
            <Link href="/admin/users" class="btn btn-secondary">Отмена</Link>
        </form>
    </AppLayout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    props: {
        user: Object,
    },
    data() {
        return {
            form: {
                name: this.user.name,
                email: this.user.email,
                password: '',
                role: this.user.role,
            }
        };
    },
    methods: {
        submit() {
            router.put(`/admin/users/${this.user.id}`, this.form);
        }
    }
};
</script>