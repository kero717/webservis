<template>
    <AppLayout>
        <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ book.title }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-3">Автор:</dt>
                                <dd class="col-sm-9">{{ book.author }}</dd>

                                <dt class="col-sm-3">Жанр:</dt>
                                <dd class="col-sm-9">{{ book.genre || 'Не указан' }}</dd>

                                <dt class="col-sm-3">Издатель:</dt>
                                <dd class="col-sm-9">{{ book.publisher || 'Не указан' }}</dd>

                                <dt class="col-sm-3">Год издания:</dt>
                                <dd class="col-sm-9">{{ book.year || 'Не указан' }}</dd>

                                <dt class="col-sm-3">ISBN:</dt>
                                <dd class="col-sm-9">{{ book.isbn || 'Не указан' }}</dd>

                                <dt class="col-sm-3">Доступно экземпляров:</dt>
                                <dd class="col-sm-9">{{ book.available_copies }} из {{ book.copies }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-3">
                        <Link href="/books" class="btn btn-secondary">Назад к списку</Link>
                        <Link v-if="canManageBooks" :href="`/books/${book.id}/edit`" class="btn btn-warning ms-2">
                            Редактировать
                        </Link>
                        <button v-if="canManageBooks" @click="deleteBook" class="btn btn-danger ms-2">
                            Удалить
                        </button>
                        <button v-if="$page.props.auth?.user?.role === 'client' && book.available_copies > 0"
                                @click="bookBook" class="btn btn-success ms-2">
                            Забронировать
                        </button>
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
        book: Object,
    },
    computed: {
        canManageBooks() {
            return ['librarian', 'admin'].includes(this.$page.props.auth?.user?.role);
        }
    },
    methods: {
        deleteBook() {
            if (confirm('Удалить книгу?')) {
                router.delete(`/books/${this.book.id}`);
            }
        },
        bookBook() {
            if (confirm('Забронировать книгу?')) {
                router.post(`/books/${this.book.id}/book`);
            }
        }
    }
};
</script>