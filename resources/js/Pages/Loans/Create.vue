<template>
    <AppLayout>
        <div class="container">
            <h1>Новая выдача</h1>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="user_id" class="form-label">Читатель</label>
                    <select class="form-control" id="user_id" v-model="form.user_id" required>
                        <option value="">-- Выберите читателя --</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }} ({{ user.email }})
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="book_id" class="form-label">Книга</label>
                    <select class="form-control" id="book_id" v-model="form.book_id" required>
                        <option value="">-- Выберите книгу --</option>
                        <option v-for="book in books" :key="book.id" :value="book.id">
                            {{ book.title }} ({{ book.author }}) – доступно {{ book.available_copies }}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="booking_id" class="form-label">Или выберите бронь (необязательно)</label>
                    <select class="form-control" id="booking_id" v-model="form.booking_id">
                        <option value="">-- Без брони --</option>
                        <option v-for="booking in bookings" :key="booking.id" :value="booking.id">
                            {{ booking.user.name }} – {{ booking.book.title }} (до {{ formatDate(booking.expires_at) }})
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Выдать</button>
                <Link href="/loans" class="btn btn-secondary ms-2">Отмена</Link>
            </form>
        </div>
    </AppLayout>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    props: {
        users: Array,
        books: Array,
        bookings: Array,
        selectedBooking: Object,
    },
    data() {
        return {
            form: {
                user_id: this.selectedBooking?.user_id || '',
                book_id: this.selectedBooking?.book_id || '',
                booking_id: this.selectedBooking?.id || '',
            },
        };
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleString('ru-RU', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
        },
        submit() {
            router.post('/loans', this.form);
        },
    },
};
</script>