<template>
    <Laboratory title="Medical Records">
        <div class="w-full  flex-col justify-center ">
            <div class="flex flex-row my-2 justify-evenly">
                <Link v-if="infirmary_id" :href="route('records.medcert', {id: infirmary_id})" class="gap-1 py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-95 hover:bg-vsu-olive">
                    Generate Medical Certificate
                </Link>
            </div>
            <div class="flex flex-col justify-center">
                <ViewForm :link="route('records')">
                    <ViewHeader>MEDICAL RECORD</ViewHeader>
                    <div class="grid grid-rows-1 mb-5" v-if="data">
                        <div class="flex flex-row justify-between">
                            <ViewField label="No." :value="data.infirmary_id" />
                            <ViewField label="Date Issued" :value="formattedDate(data.created_at)" />
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <ViewField label="Full name" :value="formattedFullName(data)" />
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
                        <div class="my-5">
                            <table class="table table-auto border-collapse">
                                <thead>
                                    <medical-th>Examination Record</medical-th>
                                    <medical-th v-for="physical_exam in data.physical_exam">Date: {{ formattedDate(physical_exam.created_at) }} </medical-th>
                                </thead>
                                <tbody>
                                    <medical-row>
                                        <medical-th>Weight</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.weight }} kg</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Height</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.height }} cm</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Blood Pressure</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.blood_pressure }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Pulse</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.pulse }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Previous Diseases and Operation</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.prev_illns_oprtn }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Immunization or Vaccination</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.immnztn_vccntn }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Head and Neck</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.head_neck }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Scalp and Face</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.scalp_face }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Neck and Thyroid</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.neck_thyroid }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Lymph Glands</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.lymph_glands }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Eyes</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam"></medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Vision with Glasses</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.vision_with_glasses }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Vision without Glasses</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.vision_without_glasses }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Mouth and Throat</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam"></medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Tonsils</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.mouth_throat_tonsils }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Teeth</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.mouth_throat_teeth }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Heart</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.heart }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Lungs</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.lung }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Abdomen</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam"></medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Tenderness</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.abdomen_tenderness }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Mass</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.abdomen_mass }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Scars</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.abdomen_scars }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Reproductive Organ</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.abdomen_rep_organ }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Spine and Extremities</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam"></medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Deformities</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.spine_extrts_deformities }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Varicosities</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.spine_extrts_varicosities }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>&nbsp;&nbsp;&nbsp;&nbsp;Feet</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.spine_extrts_feet }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Skin Diseases</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.skin_diseases }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Radiography</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.radiography }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Laboratory</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.laboratory }}</medical-td>
                                    </medical-row>
                                    <medical-row>
                                        <medical-th>Remarks</medical-th>
                                        <medical-td v-for="physical_exam in data.physical_exam">{{ physical_exam.remarks }}</medical-td>
                                    </medical-row>
                                </tbody>
                            </table>
                            <div class="pt-5 text-xs">
                                <span>PERMISSION TO TREAT (Requires signature of parent/guardian of student under the age 18)</span>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I give my permission for my daughter/son/ward to receive medical and counselling care by the Visayas State University (VSU) Hospital in the event of any injury or illness and dental procedures. I understand that I will be responsible for all charges of the health services provided by the VSU Hospital.</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Likewise, I give my consent for my daughter/son/ward to be subjected to a periodic random drug testing with the university might require to its students.</p>
                                <div class="flex justify-between mt-10">
                                    <div class="border-t w-fit border-gray-900">
                                        Signature over printed name of Parent/Guardian
                                    </div>
                                    <div class="border-t w-fit border-gray-900">
                                        Date(mm-dd-yyyy)
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!data.fecalysis.length && !data.hematology.length && !data.urinalysis.length && !data.xray.length && !data.dental.length && !data.physical_exam.length"
                             class="text-center font-bold text-xl" >
                            <span>No Medical Records Found</span>
                        </div>
                    </div>
                    <div v-else class="text-center">
                        <span>Unable to retrieve Medical Records</span>
                    </div>
                </ViewForm>

                <div v-if="data" class="flex flex-col mt-16">
                    <div v-if="data.urinalysis.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Urinalysis Results</h1>
                        <MedicalResultCard v-if="data.urinalysis.length" v-for="urinalysis in data.urinalysis" >
                            <template #details>
                                <ViewField label="Date of Examination" :value="formattedDate(urinalysis.created_at)" />
                                <ViewField label="Status" :value="urinalysis.status.toString().toUpperCase()" />
                            </template>
                            <template #content>
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
                            </template>
                        </MedicalResultCard>
                    </div>
                    <div v-if="data.fecalysis.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Fecalysis Results</h1>
                        <MedicalResultCard v-if="data.fecalysis.length" v-for="fecalysis in data.fecalysis">
                            <template #details>
                                <ViewField label="Date of Examination" :value="formattedDate(fecalysis.created_at)" />
                                <ViewField label="Status" :value="fecalysis.status.toString().toUpperCase()" />
                            </template>
                            <template #content>
                                <ViewField label="Color" :value="fecalysis.fecalysis.color" />
                                <ViewField label="Consistency" :value="fecalysis.fecalysis.consistency" />
                                <ViewField label="WBC" :value="fecalysis.fecalysis.wbc" />
                                <ViewField label="RBC" :value="fecalysis.fecalysis.rbc" />
                                <ViewField label="Fat Globules" :value="fecalysis.fecalysis.fat_globules" />
                                <ViewField label="Others" :value="fecalysis.fecalysis.others" />
                                <ViewField label="Remarks" :value="fecalysis.fecalysis.remarks" />
                            </template>
                        </MedicalResultCard>
                    </div>
                    <div v-if="data.hematology.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Hematology Results</h1>
                        <MedicalResultCard v-if="data.hematology.length" v-for="hematology in data.hematology">
                            <template #details>
                                <ViewField label="Date of Examination" :value="formattedDate(hematology.created_at)" />
                                <ViewField label="Status" :value="hematology.status.toString().toUpperCase()" />
                            </template>
                            <template #content>
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
                            </template>
                        </MedicalResultCard>
                    </div>
                    <div v-if="data.xray.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Radiology Results</h1>
                        <MedicalResultCard v-for="xray in data.xray">
                            <template #details>
                                <ViewField label="Date of Examination" :value="formattedDate(xray.created_at)" />
                                <ViewField label="Status" :value="xray.status.toString().toUpperCase()" />
                            </template>
                            <template #content>
                                <ViewField label="Purpose" :value="xray.rqst_for" />
                                <ViewField label="Procedure" :value="xray.xray.procedure" />
                                <ViewField label="Impression" :value="xray.xray.impression" />
                                <ViewField label="Radiographic Findings" :value="xray.xray.radiographic_findings" />
                            </template>
                        </MedicalResultCard>
                    </div>
                    <div v-if="data.dental.length">
                        <h1 class="w-full text-center font-semibold text-gray-900 uppercase">Dental Results</h1>
                        <MedicalResultCard v-for="dental in data.dental">
                            <template #details>
                                <ViewField label="Date of Examination" :value="formattedDate(dental.created_at)" />
                                <ViewField label="Status" :value="dental.status.toString().toUpperCase()" />
                            </template>
                            <template #content>
                                <ViewField label="Number of Teeth Present" :value="dental.dental.cnt_prst_teeth" />
                                <ViewField label="Caries indicated for Filing" :value="dental.dental.cnt_indct_filing" />
                                <ViewField label="Caries indicated for Extraction" :value="dental.dental.cnt_indct_extraction" />
                                <ViewField label="Root Fragment" :value="dental.dental.root_frgmt" />
                                <ViewField label="Missing Due to Caries" :value="dental.dental.cnt_mssng_due_caries" />
                                <ViewField label="Filled of Restored" :value="dental.dental.filled_restored" />
                                <ViewField label="Total DF and DMF Teeth" :value="dental.dental.cnt_df_dmf" />
                                <ViewField label="Fluoride Application" :value="dental.dental.flouride_app" />
                            </template>
                        </MedicalResultCard>
                    </div>
                </div>
            </div>
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
import MedicalRow from "@/Components/Generic/MedicalForm/MedicalRow.vue";
import MedicalTd from "@/Components/Generic/MedicalForm/MedicalTd.vue";
import MedicalTh from "@/Components/Generic/MedicalForm/MedicalTh.vue";
import MedicalResultCard from "@/Components/Generic/MedicalForm/MedicalResultCard.vue";
</script>
<script>
export default {
    data: () => ({
        data: null,
        infirmary_id: null,
        is_open: false,
    }),
    mounted() {
        this.data = this.$page.props.data.data;
        //this.fetchData();
        this.infirmary_id = this.data.infirmary_id;
    },
    methods: {
        formattedFullName(data) {
            return `${data.last_name}, ${data.first_name} ${data.middle_name?data.middle_name[0]+'.':''} ${data.suffix?data.suffix:''}`;
        },
        formattedDate(date) {
            return new Date(date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        },
        async fetchData(){
            await axios.get(route('api.record.show', 102))
                .then(res => {
                    this.data = res.data;
                    console.log(this.data);
                })
        }
    },
}
</script>
