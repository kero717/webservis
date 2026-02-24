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