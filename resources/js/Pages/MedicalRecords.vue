<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Toolbar from '@/Pages/Records/ToolbarRecord.vue';
</script>
<template>
    <AppLayout title="Records">
        <template #toolbar>
            <Toolbar></Toolbar>
        </template>
        <slot></slot>
    </AppLayout>
</template>
