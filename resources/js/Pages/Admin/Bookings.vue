<template>
    <AppLayout>
        <div class="container mt-4">
            <h1>Все бронирования</h1>

            <div v-if="bookings.length === 0" class="alert alert-info">
                Нет активных бронирований.
            </div>

            <div v-else class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Книга</th>
                            <th>Автор</th>
                            <th>Пользователь</th>
                            <th>Email</th>
                            <th>Забронировано до</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="booking in bookings" :key="booking.id">
                            <td>{{ booking.book.title }}</td>
                            <td>{{ booking.book.author }}</td>
                            <td>{{ booking.user.name }}</td>
                            <td>{{ booking.user.email }}</td>
                            <td>{{ formatDate(booking.expires_at) }}</td>
                            <td>
                                <Link :href="`/loans/create?booking_id=${booking.id}`" class="btn btn-success btn-sm">
                                    Выдать
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { Link, AppLayout },
    props: {
        bookings: Array,
    },
    methods: {
        formatDate(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('ru-RU');
        }
    }
};
</script>