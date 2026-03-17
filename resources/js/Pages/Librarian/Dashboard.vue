<template>
    <AppLayout>
        <div class="container mt-4">
            <h1>Панель библиотекаря</h1>
            <p>Добро пожаловать, {{ $page.props.auth?.user?.name }} (роль: библиотекарь)</p>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: { AppLayout },
};
</script>