<template>
    <AppLayout>
        <div class="container mt-5" style="max-width: 400px;">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Вход в систему</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input v-model="form.email" type="email" class="form-control" id="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input v-model="form.password" type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input v-model="form.remember" type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                                Войти
                            </button>
                        </div>
                        <div class="mt-3 text-center">
                            <Link href="/register" class="text-decoration-none">Нет аккаунта? Зарегистрироваться</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember: false,
            },
            loading: false,
        };
    },
    methods: {
        submit() {
            this.loading = true;
            router.post('/login', this.form, {
                onFinish: () => this.loading = false,
            });
        }
    }
};
</script>