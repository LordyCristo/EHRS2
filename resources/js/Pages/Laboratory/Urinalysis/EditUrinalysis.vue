<template>
    <Laboratory title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <UrinalysisForm :action="action"/>
            </div>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import UrinalysisForm from "@/Pages/Laboratory/Urinalysis/UrinalysisForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'update',
    }),
}
</script>
