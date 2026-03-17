<template>
    <AppLayout>
        <div class="container mt-4">
            <h1 class="mb-4">📚 Каталог книг</h1>

            <!-- Поиск -->
            <form @submit.prevent="searchBooks" class="mb-4">
                <div class="input-group">
                    <input type="text" v-model="search" class="form-control" placeholder="Поиск по названию, автору, жанру, издателю...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i> Найти</button>
                </div>
            </form>

            <!-- Кнопка добавления -->
            <Link v-if="canManageBooks" href="/books/create" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Добавить книгу
            </Link>

            <div v-if="books.length === 0" class="alert alert-info">Книг пока нет.</div>

            <div class="row">
                <div v-for="book in books" :key="book.id" class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ book.title }}</h5>
                            <p class="card-text"><strong>Автор:</strong> {{ book.author }}</p>
                            <p class="card-text"><strong>Жанр:</strong> {{ book.genre || 'Не указан' }}</p>
                            <p class="card-text"><strong>Доступно:</strong> {{ book.available_copies }} из {{ book.copies }}</p>
                            <Link :href="`/books/${book.id}`" class="btn btn-sm btn-outline-primary"><i class="fas fa-info-circle"></i> Подробнее</Link>
                            <template v-if="canManageBooks">
                                <Link :href="`/books/${book.id}/edit`" class="btn btn-sm btn-outline-warning ms-1"><i class="fas fa-edit"></i></Link>
                                <button @click="deleteBook(book.id)" class="btn btn-sm btn-outline-danger ms-1"><i class="fas fa-trash"></i></button>
                            </template>
                        </div>
                    </div>
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
    props: { books: Array, filters: Object },
    data() { return { search: this.filters?.search || '' }; },
    computed: {
        canManageBooks() { return ['librarian', 'admin'].includes(this.$page.props.auth?.user?.role); }
    },
    methods: {
        searchBooks() { router.get('/books', { search: this.search }, { preserveState: true }); },
        deleteBook(id) { if (confirm('Удалить книгу?')) router.delete(`/books/${id}`); }
    }
};
</script>