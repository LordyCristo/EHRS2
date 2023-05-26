<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Financial Department">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Finance Page
            </h2>
        </template>
        <slot />
    </AppLayout>
</template>
