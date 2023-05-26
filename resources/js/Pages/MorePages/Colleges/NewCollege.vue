<template>
    <MorePages title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm w-1/2">
                <CollegeForm :action="action"/>
            </div>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import CollegeForm from "@/Pages/MorePages/Colleges/CollegeForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
