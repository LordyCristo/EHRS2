<template>
    <Laboratory title="View Hematology">
        <ViewForm :link="route('laboratory.fecalysis.index')">
            <div class="printTable flex flex-col">
                <div class="inline-flex text-center justify-between mb-1 gap-1">
                    <img src="../../../Components/Icons/vsu-name-logo.png" alt="Visayas State University Logo" class="vsu-logo w-[15rem] h-auto">
                    <h1 class="header-text text-right m-0 p-0 font-bold text-sm font-montserrat max-w-xs">
                        OFFICE OF THE CHIEF OF UNIVERSITY SERVICES FOR HEALTH EMERGENCY AND RESCUE (USHER)
                    </h1>
                </div>
                <div class="text-center font-bold text-xl uppercase my-3">
                    <h2 class="form-title">Fecalysis Report</h2>
                </div>
                <div class="grid grid-rows-2" v-if="data">
                    <div class="flex flex-row justify-between px-2 gap-2">
                        <span class="flex items-center gap-1"><b>Patient:</b> {{ data.infirmary_id }}</span>
                        <span class="flex items-center gap-1"><b>Age:</b> {{ data.age }}</span>
                        <span class="flex items-center gap-1"><b>Sex:</b> {{ data.sex }}</span>
                        <span class="flex items-center gap-1"><b>Hospital No.:</b> {{ data.age }}</span>
                        <span class="flex items-center gap-1"><b>Ward:</b> {{ data.ward }}</span>
                        <span class="flex items-center gap-1"><b>OR No.:</b> {{ data.or_no?data.or_no:'Unpaid' }}</span>
                    </div>
                    <div class="flex flex-row justify-between px-2 gap-2">
                        <span class="flex items-center gap-1"><b>Requesting Physician:</b> Dr. {{ data.rqst_physician.first_name }} {{ data.rqst_physician.middle_name[0] }}. {{ data.rqst_physician.last_name }} {{ data.rqst_physician.suffix }}</span>
                        <span class="flex items-center gap-1"><b>Date:</b> {{ new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                    </div>
                    <div class="mt-3">
                        <table class="w-full">
                            <thead>
                            <tr class="bg-vsu-green text-white">
                                <th colspan="2">Macroscopic</th>
                                <th colspan="2"  >Microscopic</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Color</b></td>
                                    <td>{{ data.fecalysis.color }}</td>
                                    <td colspan="2"><b>Ova:</b></td>
                                </tr>
                                <tr>
                                    <td><b>Consistency</b></td>
                                    <td>{{ data.fecalysis.consistency }}</td>
                                    <td colspan="2">{{ data.fecalysis.ova }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><b>White Blood Cells</b></td>
                                    <td>{{ data.fecalysis.wbc }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><b>Red Blood Cells</b></td>
                                    <td>{{ data.fecalysis.rbc }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><b>Fat Globules</b></td>
                                    <td>{{ data.fecalysis.fat_globules }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Others:</b></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Remarks:</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="grid grid-cols-2 mt-14">
                            <div class="flex flex-col text-center">
                                <span class="underline font-bold uppercase">{{ data.medical_technologist.first_name }} {{ data.medical_technologist.middle_name[0] }}. {{ data.medical_technologist.last_name }} {{ data.medical_technologist.suffix }}</span>
                                <span>License No. {{ data.medical_technologist.license_no }}</span>
                                <span>{{ 'Medical Technologist' }}</span>
                            </div>
                            <div class="flex flex-col text-center">
                                <span class="underline font-bold uppercase">{{ data.pathologist.first_name }} {{ data.pathologist.middle_name[0] }}. {{ data.pathologist.last_name }} {{ data.pathologist.suffix }}</span>
                                <span>License No. {{ data.pathologist.license_no }}</span>
                                <span>{{ 'Pathologist' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ViewForm>
    </Laboratory>
</template>
<style>
td {
    padding: 0.5rem;
    @apply border;
}
</style>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
</script>
<script>
export default {
    data: () => ({
        data: null,

    }),
    mounted() {
        this.data = this.$page.props.data.data;
    },
}
</script>
