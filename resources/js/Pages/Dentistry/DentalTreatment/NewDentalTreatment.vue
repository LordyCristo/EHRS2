<template>
    <Dental title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <DentalTreatmentForm :action="action"/>
            </div>
        </div>
    </Dental>
</template>
<script setup>
import DentalTreatmentForm from "@/Pages/Dentistry/DentalTreatment/DentalTreatmentForm.vue";
import Dental from "@/Pages/Dental.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
