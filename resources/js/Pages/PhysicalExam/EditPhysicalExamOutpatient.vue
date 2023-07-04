<template>
    <PhysicalExam title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
                <PhysicalExamFormOutpatient :action="action" />
            </div>
        </div>
    </PhysicalExam>
</template>
<script setup>
import PhysicalExam from "@/Pages/PhysicalExam.vue";
import PhysicalExamFormOutpatient from '@/Pages/PhysicalExam/PhysicalExamOutpatient.vue';
</script>
<script>
export default {
    data: () => ({
        action: 'update',
    }),
}
</script>
