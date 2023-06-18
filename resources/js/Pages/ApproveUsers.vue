<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Toolbar from '@/Pages/MorePages/ToolbarMorePage.vue';
</script>
<template>
    <AppLayout title="User Approval">
        <template #toolbar>
            <Toolbar></Toolbar>
        </template>
        <slot></slot>
    </AppLayout>
</template>
