<template>
    <div v-if="data.length">
        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Fecalysis Results</h1>
        <div v-for="fecalysis in data.fecalysis" class="flex flex-col gap-3 rounded-md my-3">
            <div class="grid grid-cols-2 text-white px-2 py-1" style="background-color: rgb(6, 67, 13); color: white;">
                <ViewField label="Date of Examination" :value="formattedDate(fecalysis.created_at)" />
                <div class="flex flex-row justify-between items-center">
                    <ViewField label="Status" :value="fecalysis.status.toString().toUpperCase()" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-1 px-2 pb-2">
                <ViewField label="Color" :value="fecalysis.fecalysis.color" />
                <ViewField label="Consistency" :value="fecalysis.fecalysis.consistency" />
                <ViewField label="Ova" :value="fecalysis.fecalysis.ova" />
                <ViewField label="WBC" :value="fecalysis.fecalysis.wbc" />
                <ViewField label="RBC" :value="fecalysis.fecalysis.rbc" />
                <ViewField label="Fat Globules" :value="fecalysis.fecalysis.fat_globules" />
                <ViewField label="Others" :value="fecalysis.fecalysis.others" />
                <ViewField label="Remarks" :value="fecalysis.fecalysis.remarks" />
            </div>
        </div>
    </div>
</template>
<script setup>
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import {ref} from "vue";

const data = ref([]);

const formattedDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};
</script>
