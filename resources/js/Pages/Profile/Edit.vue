<template>
    <AppLayout>
        <div class="container mt-4">
            <h1>Редактирование профиля</h1>

            <!-- Форма имени и email -->
            <div class="card mb-4">
                <div class="card-header">Информация профиля</div>
                <div class="card-body">
                    <form @submit.prevent="updateProfile">
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input v-model="profileForm.name" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input v-model="profileForm.email" type="email" class="form-control" id="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>

            <!-- Форма смены пароля -->
            <div class="card">
                <div class="card-header">Сменить пароль</div>
                <div class="card-body">
                    <form @submit.prevent="updatePassword">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Текущий пароль</label>
                            <input v-model="passwordForm.current_password" type="password" class="form-control" id="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Новый пароль</label>
                            <input v-model="passwordForm.new_password" type="password" class="form-control" id="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Подтверждение пароля</label>
                            <input v-model="passwordForm.new_password_confirmation" type="password" class="form-control" id="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Сменить пароль</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { AppLayout },
    props: {
        user: Object,
    },
    data() {
        return {
            profileForm: {
                name: this.user.name,
                email: this.user.email,
            },
            passwordForm: {
                current_password: '',
                new_password: '',
                new_password_confirmation: '',
            },
        };
    },
    methods: {
        updateProfile() {
            router.put('/user/profile-information', this.profileForm);
        },
        updatePassword() {
            router.put('/user/password', this.passwordForm);
        },
    },
};
</script>