<template>
    <AppLayout>
        <div class="container mt-4">
            <h1 class="mb-4"><i class="fas fa-plus-circle"></i> Добавить книгу</h1>
            <form @submit.prevent="submit" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="title" class="form-label">Название *</label>
                    <input v-model="form.title" type="text" class="form-control" id="title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Автор *</label>
                    <input v-model="form.author" type="text" class="form-control" id="author" required>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Жанр</label>
                    <input v-model="form.genre" type="text" class="form-control" id="genre">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Издатель</label>
                    <input v-model="form.publisher" type="text" class="form-control" id="publisher">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Год</label>
                    <input v-model="form.year" type="number" class="form-control" id="year" min="1800" :max="new Date().getFullYear()">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input v-model="form.isbn" type="text" class="form-control" id="isbn">
                </div>
                <div class="mb-3">
                    <label for="copies" class="form-label">Количество экземпляров *</label>
                    <input v-model="form.copies" type="number" class="form-control" id="copies" min="1" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Сохранить</button>
                    <Link href="/books" class="btn btn-secondary ms-2"><i class="fas fa-times"></i> Отмена</Link>
                </div>
            </form>
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
            form: { title: '', author: '', genre: '', publisher: '', year: '', isbn: '', copies: 1 }
        };
    },
    methods: {
        submit() { router.post('/books', this.form); }
    }
};
</script>