<template>
    <AppLayout>
        <h1>Журнал выдач книг</h1>

        <!-- Кнопка новой выдачи (только для библиотекаря/админа) -->
        <Link v-if="canManageLoans" href="/loans/create" class="btn btn-primary mb-3">
            Новая выдача
        </Link>

        <div v-if="loans.length === 0" class="alert alert-info">
            Нет записей о выдаче.
        </div>

        <table v-else class="table table-striped">
            <thead>
                <tr>
                    <th>Книга</th>
                    <th>Читатель</th>
                    <th>Выдана</th>
                    <th>Должна быть возвращена</th>
                    <th>Возвращена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="loan in loans" :key="loan.id">
                    <td>{{ loan.book.title }}</td>
                    <td>{{ loan.user.name }}</td>
                    <td>{{ formatDate(loan.loaned_at) }}</td>
                    <td>{{ formatDate(loan.due_at) }}</td>
                    <td>
                        <span v-if="loan.returned_at" class="badge bg-success">
                            {{ formatDate(loan.returned_at) }}
                        </span>
                        <span v-else class="badge bg-warning">Не возвращена</span>
                    </td>
                    <td>
                        <button v-if="!loan.returned_at" @click="returnBook(loan.id)" class="btn btn-success btn-sm">
                            Принять
                        </button>
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
        loans: Array,
    },
    computed: {
        canManageLoans() {
            return ['librarian', 'admin'].includes(this.$page.props.auth?.user?.role);
        }
    },
    methods: {
        formatDate(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('ru-RU');
        },
        returnBook(loanId) {
            if (confirm('Подтвердить возврат книги?')) {
                router.patch(`/loans/${loanId}/return`);
            }
        }
    }
};
</script>