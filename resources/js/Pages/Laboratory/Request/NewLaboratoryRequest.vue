<template>
    <Laboratory title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <LaboratoryRequestForm :action="action"/>
            </div>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import LaboratoryRequestForm from "@/Pages/Laboratory/Request/LaboratoryRequestForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
