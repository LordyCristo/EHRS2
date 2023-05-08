<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Toolbar from '@/Pages/Radiology/ToolbarRadiology.vue';
</script>
<template>
    <AppLayout title="Radiology">
        <template #toolbar>
            <Toolbar></Toolbar>
        </template>
        <slot></slot>
    </AppLayout>
</template>
 