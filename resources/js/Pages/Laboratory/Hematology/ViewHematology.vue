<template>
    <Laboratory title="View Hematology">
        <ViewForm :link="route('laboratory.hematology.index')">
            <div class="printTable flex flex-col min-w-xl">
                <div class="inline-flex text-center justify-between mb-1 gap-1">
                    <img src="../../../Components/Icons/vsu-name-logo.png" alt="Visayas State University Logo" class="vsu-logo w-[15rem] h-auto">
                    <h1 class="header-text text-right m-0 p-0 font-bold text-sm font-montserrat max-w-xs">
                        OFFICE OF THE CHIEF OF UNIVERSITY SERVICES FOR HEALTH EMERGENCY AND RESCUE (USHER)
                    </h1>
                </div>
                <div class="text-center font-bold text-xl uppercase my-3">
                    <h2 class="form-title">Hematology Report</h2>
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
                                <th>Examination</th>
                                <th>Results</th>
                                <th>Normal Values</th>
                                <th>Examination</th>
                                <th>Results</th>
                                <th>Normal Values</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="font-bold">
                                    Hemoglobin
                                </td>
                                <td>
                                    {{ data.hematology.hemoglobin }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span>NB</span><span>17.0-22.0 g/dl</span></li>
                                        <li class="flex justify-between"><span>Child</span><span>12.0-15.0 g/dl</span></li>
                                        <li class="flex justify-between"><span>F</span><span>11.0-16.0 g/dl</span></li>
                                        <li class="flex justify-between"><span>M</span><span>14.0-18.0 g/dl</span></li>
                                    </ul>
                                </td>
                                <td class="font-bold">
                                    Segmenters
                                </td>
                                <td>
                                    {{ data.hematology.segmenters }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between text-center">0.50 - 0.70</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold">
                                    Hematocrit
                                </td>
                                <td>
                                    {{ data.hematology.hematocrit }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span>NB</span><span>0.35 - 0.49</span></li>
                                        <li class="flex justify-between"><span>Child</span><span>0.35 - 0.49</span></li>
                                        <li class="flex justify-between"><span>F</span><span>0.36 - 0.48</span></li>
                                        <li class="flex justify-between"><span>M</span><span>0.40 - 0.54</span></li>
                                    </ul>
                                </td>
                                <td class="font-bold">
                                    Lymphocyte
                                </td>
                                <td>
                                    {{ data.hematology.lymphocyte }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between">0.20 - 0.40</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold">
                                    White Blood Cells
                                </td>
                                <td>
                                    {{ data.hematology.wbc }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span>NB</span><span>15.0 - 22.0 x 10<sup>9</sup>/L</span></li>
                                        <li class="flex justify-between"><span>Child</span><span>5.0 - 12.0 x 10<sup>9</sup>/L</span></li>
                                        <li class="flex justify-between"><span>F</span><span>4.0 - 10.0 x 10<sup>9</sup>/L</span></li>
                                        <li class="flex justify-between"><span>M</span><span>4.0 - 10.0 x 10<sup>9</sup>/L</span></li>
                                    </ul>
                                </td>
                                <td class="font-bold">
                                    Monoctye
                                </td>
                                <td>
                                    {{ data.hematology.monocyte }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span>0.01 - 0.15</span></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold">
                                    Red Blood Cells
                                </td>
                                <td>
                                    {{ data.hematology.rbc }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span>NB</span><span>6.0 - 7.0 x 10<sup>12</sup>/L</span></li>
                                        <li class="flex justify-between"><span>Child</span><span>4.0 - 5.2 x 10<sup>12</sup>/L</span></li>
                                        <li class="flex justify-between"><span>F</span><span>3.5.0 - 5.5 x 10<sup>12</sup>/L</span></li>
                                        <li class="flex justify-between"><span>M</span><span>4.5 - 6.0 x 10<sup>12</sup>/L</span></li>
                                    </ul>
                                </td>
                                <td class="font-bold">
                                    Blood Type
                                </td>
                                <td>
                                    {{ data.hematology.blood_type }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="font-bold">
                                    Platelet Count
                                </td>
                                <td>
                                    {{ data.hematology.platelet_count }}
                                </td>
                                <td>
                                    <ul class="font-bold">
                                        <li class="flex justify-between"><span></span><span>150 - 450 x 10<sup>9</sup>/L</span></li>
                                    </ul>
                                </td>
                                <td class="font-bold">
                                    Others
                                </td>
                                <td>

                                </td>
                                <td></td>
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
