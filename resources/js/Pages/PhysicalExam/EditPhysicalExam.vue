<template>
    <PhysicalExam title="Update Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
                <PhysicalExamForm :action="action" />
            </div>
        </div>
    </PhysicalExam>
</template>
<script setup>
import PhysicalExam from "@/Pages/PhysicalExam.vue";
import PhysicalExamForm from '@/Pages/PhysicalExam/PhysicalExamForm.vue';
</script>
<script>
export default {
    data: () => ({
        action: 'update',
    }),
}
</script>
