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
    mounted() {
        console.log(this.$page.props);
    }
};
</script>

<template>
    <AppLayout title="Dental">
        <template #toolbar>
            <ToolbarMorePage />
        </template>
        <div>
            {{ results }}
        </div>
        <div>
            {{ records }}
        </div>
        <div>
            {{ treatments }}
        </div>
        <slot></slot>
    </AppLayout>
</template>
