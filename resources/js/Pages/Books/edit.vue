<template>
    <AppLayout>
        <div class="container">
            <h1>Редактировать книгу</h1>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="title" class="form-label">Название *</label>
                    <input type="text" class="form-control" id="title" v-model="form.title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Автор *</label>
                    <input type="text" class="form-control" id="author" v-model="form.author" required>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Жанр</label>
                    <input type="text" class="form-control" id="genre" v-model="form.genre">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Издатель</label>
                    <input type="text" class="form-control" id="publisher" v-model="form.publisher">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Год</label>
                    <input type="number" class="form-control" id="year" v-model="form.year" min="1800" max="2099">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" v-model="form.isbn">
                </div>
                <div class="mb-3">
                    <label for="copies" class="form-label">Количество экземпляров *</label>
                    <input type="number" class="form-control" id="copies" v-model="form.copies" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
                <Link :href="route('books.index')" class="btn btn-secondary ms-2">Отмена</Link>
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
        book: Object,
    },
    data() {
        return {
            form: {
                title: this.book.title,
                author: this.book.author,
                genre: this.book.genre || '',
                publisher: this.book.publisher || '',
                year: this.book.year || '',
                isbn: this.book.isbn || '',
                copies: this.book.copies,
            },
        };
    },
    methods: {
        submit() {
            router.put(`/books/${this.book.id}`, this.form);
        },
    },
};
</script>