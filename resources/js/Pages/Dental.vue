<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolbarMorePage from "@/Pages/MorePages/ToolbarMorePage.vue";
</script>
<script>
export default {
    props: {
        results: Object,
        records: Object,
        treatments: Object,
    },
};
</script>

<template>
    <AppLayout title="Dental">
        <template #toolbar>
            <ToolbarMorePage />
        </template>
        <slot></slot>
    </AppLayout>
</template>
