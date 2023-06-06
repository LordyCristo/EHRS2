<template>
    <Radiology title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <RadiologyForm :action="action"/>
            </div>
        </div>
    </Radiology>
</template>
<script setup>
import Radiology from "@/Pages/Radiology.vue";
import RadiologyForm from "@/Pages/Radiology/Result/RadiologyForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
