<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = ref({
    name: '',
    description: ''
});

const submit = () => {
    router.post('/books', form.value);
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Книги</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">
                            <input v-model="form.name" placeholder="Название" class="border p-2 w-full mb-4">
                            <textarea v-model="form.description" placeholder="Описание" class="border p-2 w-full mb-4"></textarea>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<template>
    <AppLayout>
        <h1>Каталог книг</h1>

        <!-- Форма поиска -->
        <form @submit.prevent="searchBooks" class="mb-4">
            <div class="input-group">
                <input type="text" v-model="search" class="form-control" placeholder="Поиск по названию, автору, жанру, издателю...">
                <button class="btn btn-outline-secondary" type="submit">Найти</button>
            </div>
        </form>

        <!-- Кнопка добавления книги (только библиотекарь/админ) -->
        <Link v-if="['librarian', 'admin'].includes($page.props.auth.user?.role)" href="/books/create" class="btn btn-primary mb-3">
            Добавить книгу
        </Link>

        <!-- Список книг -->
        <div class="row">
            <div v-for="book in books" :key="book.id" class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ book.title }}</h5>
                        <p class="card-text">Автор: {{ book.author }}</p>
                        <p class="card-text">Жанр: {{ book.genre || 'Не указан' }}</p>
                        <p class="card-text">Доступно: {{ book.available_copies }} из {{ book.copies }}</p>
                        <Link :href="`/books/${book.id}`" class="btn btn-primary btn-sm">Подробнее</Link>

                        <!-- Кнопки для библиотекаря/админа -->
                        <template v-if="['librarian', 'admin'].includes($page.props.auth.user?.role)">
                            <Link :href="`/books/${book.id}/edit`" class="btn btn-warning btn-sm">Редактировать</Link>
                            <button @click="deleteBook(book.id)" class="btn btn-danger btn-sm">Удалить</button>
                        </template>
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
    props: {
        books: Array,
        filters: Object,
    },
    data() {
        return {
            search: this.filters?.search || '',
        };
    },
    methods: {
        searchBooks() {
            router.get('/books', { search: this.search }, { preserveState: true });
        },
        deleteBook(id) {
            if (confirm('Удалить книгу?')) {
                router.delete(`/books/${id}`);
            }
        }
    }
};
</script>