<template>
    <Laboratory title="Medical Records">
        <div class="flex flex-col justify-center">
            <ViewForm :link="route('records')">
                <ViewHeader>MEDICAL RECORD</ViewHeader>
                <div class="grid grid-rows-1 gap-2 mb-5" v-if="data">
                    <div class="grid grid-cols-4 gap-5">
                        <ViewField label="No." :value="data.infirmary_id" />
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <ViewField label="Name in Full" :value="formattedFullName(data)" />
                        <div  class="grid grid-cols-2 gap-5">
                            <ViewField label="Age" :value="data.age" />
                            <ViewField label="Sex" :value="data.sex.toString().toUpperCase()" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <ViewField label="Home Address" :value="data.home_address" />
                        <div  class="grid grid-cols-2 gap-5">
                            <ViewField label="Civil Status" :value="data.civil_status.toString().toUpperCase()" />
                            <ViewField label="Birthdate" :value="formattedDate(data.birthdate)" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <ViewField label="Current Address" :value="data.curr_address" />
                        <ViewField label="Contact No." :value="data.phone" />
                    </div>
                    <div v-if="!data.fecalysis.length && !data.hematology.length && !data.urinalysis.length && !data.xray.length"
                         class="text-center font-bold text-xl" >
                        <span>No Medical Records Found</span>
                    </div>
                    <div v-if="data.fecalysis.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Fecalysis Results</h1>
                        <div v-for="fecalysis in data.fecalysis" class="flex flex-col gap-3 rounded-md my-3">
                            <div class="grid grid-cols-2 text-white px-2 py-1 rounded-tl-md rounded-tr-md" style="background-color: rgb(6, 67, 13); color: white;">
                                <ViewField label="Date of Examination" :value="formattedDate(fecalysis.created_at)" />
                                <div class="flex flex-row justify-between items-center">
                                    <ViewField label="Status" :value="fecalysis.status.toString().toUpperCase()" />
                                    <!--                                <Link :href="route('laboratory.fecalysis.edit',fecalysis.id)" class="text-gray-600 hover:text-gray-900 duration-300" title="Update">-->
                                    <!--                                    <EditIcon class="w-4 h-auto text-vsu-yellow hover:scale-125 duration-200" />-->
                                    <!--                                </Link>-->
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
                    <div v-if="data.urinalysis.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Urinalysis Results</h1>
                        <div v-for="urinalysis in data.urinalysis" class="flex flex-col gap-3 rounded-md my-3">
                            <div class="grid grid-cols-2 text-white px-2 py-1 rounded-tl-md rounded-tr-md" style="background-color: rgb(6, 67, 13); color: white;">
                                <ViewField label="Date of Examination" :value="formattedDate(urinalysis.created_at)" />
                                <ViewField label="Status" :value="urinalysis.status.toString().toUpperCase()" />
                            </div>
                            <div class="grid grid-cols-2 gap-1 px-2 pb-2">
                                <ViewField label="Color" :value="urinalysis.urinalysis.color" />
                                <ViewField label="Clarity" :value="urinalysis.urinalysis.clarity" />
                                <ViewField label="pH" :value="urinalysis.urinalysis.ph" />
                                <ViewField label="Spefic Gravity" :value="urinalysis.urinalysis.specific_gravity" />
                                <ViewField label="Albumin" :value="urinalysis.urinalysis.albumin" />
                                <ViewField label="Glucose" :value="urinalysis.urinalysis.glucose" />
                                <ViewField label="Blood" :value="urinalysis.urinalysis.blood" />
                                <ViewField label="Leukocytes" :value="urinalysis.urinalysis.leukocytes" />
                                <ViewField label="Nitrite" :value="urinalysis.urinalysis.nitrite" />
                                <ViewField label="Urobilinogen" :value="urinalysis.urinalysis.urobilinogen" />
                                <ViewField label="Bilirubin" :value="urinalysis.urinalysis.bilirubin" />
                                <ViewField label="Ketones" :value="urinalysis.urinalysis.ketones" />
                                <ViewField label="WBC" :value="urinalysis.urinalysis.wbc" />
                                <ViewField label="RBC" :value="urinalysis.urinalysis.rbc" />
                                <ViewField label="Epithelial Cells" :value="urinalysis.urinalysis.epithelial_cells" />
                                <ViewField label="Amorphous Urates" :value="urinalysis.urinalysis.amorphous_urates" />
                                <ViewField label="Amorphous Phosphates" :value="urinalysis.urinalysis.amorphous_phosphates" />
                                <ViewField label="Mucous Threads" :value="urinalysis.urinalysis.mucous_threads" />
                                <ViewField label="Crystals" :value="urinalysis.urinalysis.crystals" />
                                <ViewField label="Cast" :value="urinalysis.urinalysis.cast" />
                                <ViewField label="Remarks" :value="urinalysis.urinalysis.remarks" />
                            </div>
                        </div>
                    </div>
                    <div v-if="data.hematology.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Hematology Results</h1>
                        <div v-for="hematology in data.hematology" class="flex flex-col gap-3 rounded-md my-3">
                            <div class="grid grid-cols-2 text-white px-2 py-1 rounded-tl-md rounded-tr-md" style="background-color: rgb(6, 67, 13); color: white;">
                                <ViewField label="Date of Examination" :value="formattedDate(hematology.created_at)" />
                                <ViewField label="Status" :value="hematology.status.toString().toUpperCase()" />
                            </div>
                            <div class="grid grid-cols-2 gap-1 px-2 pb-2">
                                <ViewField label="Hemoglobin" :value="hematology.hematology.hemoglobin" />
                                <ViewField label="Hematocrit" :value="hematology.hematology.hematocrit" />
                                <ViewField label="WBC" :value="hematology.hematology.wbc" />
                                <ViewField label="RBC" :value="hematology.hematology.rbc" />
                                <ViewField label="Platelet Count" :value="hematology.hematology.platelet_count" />
                                <ViewField label="Segmenters" :value="hematology.hematology.segmenters" />
                                <ViewField label="Lymphocytes" :value="hematology.hematology.lymphocyte" />
                                <ViewField label="Monocytes" :value="hematology.hematology.monocyte" />
                                <ViewField label="Blood Type" :value="hematology.hematology.blood_type" />
                                <ViewField label="Remarks" :value="hematology.hematology.remarks" />
                            </div>
                        </div>
                    </div>
                    <div v-if="data.xray.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Radiology Results</h1>
                        <div v-for="xray in data.xray" class="flex flex-col gap-3 rounded-md my-3">
                            <div class="grid grid-cols-2 text-white px-2 py-1 rounded-tl-md rounded-tr-md" style="background-color: rgb(6, 67, 13); color: white;">
                                <ViewField label="Date of Examination" :value="formattedDate(xray.created_at)" />
                                <ViewField label="Status" :value="xray.status.toString().toUpperCase()" />
                            </div>
                            <div class="grid grid-cols-2 gap-1 px-2 pb-2">
                                <ViewField label="Purpose" :value="xray.rqst_for" />
                                <ViewField label="Procedure" :value="xray.xray.procedure" />
                                <ViewField label="Impression" :value="xray.xray.impression" />
                                <ViewField label="Radiographic Findings" :value="xray.xray.radiographic_findings" />
                            </div>
                        </div>
                    </div>
                    <div v-if="data.dental.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Dental Results</h1>
                        <div v-for="dental in data.dental" class="flex flex-col gap-3 rounded-md my-3">
                            <div class="grid grid-cols-2 text-white px-2 py-1 rounded-tl-md rounded-tr-md" style="background-color: rgb(6, 67, 13); color: white;">
                                <ViewField label="Date of Examination" :value="formattedDate(dental.created_at)" />
                                <ViewField label="Status" :value="dental.status.toString().toUpperCase()" />
                            </div>
                            <div class="grid grid-cols-2 gap-1 px-2 pb-2">
                                <ViewField label="Purpose" :value="dental.rqst_for" />
                                <ViewField label="Procedure" :value="dental.dental.procedure" />
                                <ViewField label="Impression" :value="dental.dental.impression" />
                                <ViewField label="Radiographic Findings" :value="dental.dental.radiographic_findings" />
                            </div>
                        </div>
                    </div>

                </div>
                <div v-else class="text-center">
                    <span>Unable to retrieve Medical Records</span>
                </div>
            </ViewForm>
            <Link v-if="infirmary_id" :href="route('records.medcert', {id: infirmary_id})" class="absolute top-20 right-1/3 gap-1 py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-95 hover:bg-vsu-olive">
                Generate Medical Certificate
            </Link>
        </div>
    </Laboratory>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import ViewDtLabel from "@/Components/Generic/Forms/ViewDtLabel.vue";
import ViewDtResult from "@/Components/Generic/Forms/ViewDtResult.vue";
import ViewDtNote from "@/Components/Generic/Forms/ViewDtNote.vue";
import ViewDtNoteItem from "@/Components/Generic/Forms/ViewDtNoteItem.vue";
import ViewFooter from "@/Components/Generic/Forms/ViewFooter.vue";
import ViewFooterItem from "@/Components/Generic/Forms/ViewFooterItem.vue";
import ViewDtHead from "@/Components/Generic/Forms/ViewDtHead.vue";
import {Lab_Group_5} from "@/Legends/legends";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import EditIcon from "@/Components/Icons/EditIcon.vue";
</script>
<script>
export default {
    data: () => ({
        data: null,
        infirmary_id: null,
    }),
    mounted() {
        this.data = this.$page.props.data.data;
        this.infirmary_id = this.data.infirmary_id;
    },
    methods: {
        formattedFullName(data) {
            return `${data.last_name}, ${data.first_name} ${data.middle_name?data.middle_name[0]+'.':''} ${data.suffix?data.suffix:''}`;
        },
        formattedDate(date) {
            return new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        },
    },
}
</script>
