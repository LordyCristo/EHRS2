<template>
    <Radiology title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <RadiologyRequestForm :action="action"/>
            </div>
        </div>
    </Radiology>
</template>
<script setup>
import Radiology from "@/Pages/Radiology.vue";
import RadiologyRequestForm from "@/Pages/Radiology/Request/RadiologyRequestForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
