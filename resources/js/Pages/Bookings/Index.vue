<template>
    <AppLayout>
        <div class="container mt-4">
            <h1>Мои бронирования</h1>
            <div v-if="bookings.length === 0" class="alert alert-info">
                У вас нет активных бронирований.
            </div>
            <div v-else class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Книга</th>
                            <th>Автор</th>
                            <th>Забронировано до</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="booking in bookings" :key="booking.id">
                            <td>{{ booking.book.title }}</td>
                            <td>{{ booking.book.author }}</td>
                            <td>{{ formatDate(booking.expires_at) }}</td>
                            <td>
                                <button @click="cancelBooking(booking.id)" class="btn btn-danger btn-sm">
                                    Отменить
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        bookings: Array,
    },
    methods: {
        formatDate(date) {
            if (!date) return '';
            const d = new Date(date);
            return d.toLocaleDateString('ru-RU');
        },
        cancelBooking(id) {
            if (confirm('Отменить бронь?')) {
                router.delete(`/bookings/${id}`);
            }
        }
    }
};
</script>