<template>
    <Laboratory title="Medical Records">
        <div class="flex flex-col p-5">
            <FormSection :data="data" :form="form" :action="action"
                         index-link="records"
                         :update-link="data? route('api.dental.update', data.id): null"
                         :store-link="route('api.dental.store')"
                         :delete-link="data? route('api.dental.destroy', data.id): null">
                <template #formTitle>

                </template>
                <template #formBody>
                    <ViewHeader>MEDICAL CERTIFICATE</ViewHeader>
                    <div class="grid grid-rows-3 gap-2 mb-5" v-if="data">
                        <ViewField label="Laboratory Requirements"/>
                        <div class="grid grid-cols-2">
                            <Checkbox v-model="form.cbc" label="Complete Blood Count"/>
                            <Checkbox v-model="form.urinalysis" label="Urinalysis"/>
                            <Checkbox v-model="form.chestxray" label="Chest X-ray"/>
                            <Checkbox v-model="form.fecalysis" label="Fecalysis"/>
                            <Checkbox v-model="form.drugtest" label="Drug Test"/>
                            <Checkbox v-model="form.psychological" label="Psychological"/>
                            <Checkbox v-model="form.neuropsychiatric" label="Neuropsychiatric"/>
                            <Checkbox v-model="form.nolabneeded" label="No Lab Needed"/>
                        </div>
                        <p>This is to certify that I have seen and examined Mr./Miss <b class="underline">{{ formattedFullName(data) }}</b>that he/she is physically and/or medically:
                            <RadioButton v-model="form.is_fit" :options="[{id:1,name:'fit'},{id:0,name:'unfit'},]"/>
                        </p>
                        <ViewField label="Purpose"/>
                        <div class="grid grid-rows-5">
                            <div v-for="option in purposes" :key="option.id" class="whitespace-nowrap">
                                <input type="radio" :id="'pur' + '-' + option.id" :name="name" :value="option.id"
                                       :checked="option.id === form.purpose"  @click="changePurpose(option.id)" />
                                {{ option.name }}
                            </div>
                        </div>
                        <InputText v-if="form.purpose === 4" v-model="form.purpose_sport" label="Specify Sport" />
                        <InputText v-if="form.purpose === 5" v-model="form.specific_purpose" label="Specify Purpose" />


                        <InputTextArea v-model="form.remarks" label="Remarks" />
                        <p>
                            I have examined the above-named patient and completed the evaluation. The patient does not present apparent clinical contraindications. However, if conditions arise after the student/employee/staff/faculty have been cleared, the physician may rescind the clearance until the problem is resolved.
                        </p>
                        <p>
                            <b>Physician:</b>
                            <InputTextAuto v-model="form.physician" :options="physicians"/>
                            <ViewField label="Date Issued" :value="formattedDate()"/>
                        </p>
                    </div>
                    <div v-else class="text-center">
                        <span>Unable to retrieve Medical Data</span>
                    </div>
                </template>
            </FormSection>
<!--            <ViewForm :link="route('records')">-->
<!--                -->
<!--            </ViewForm>-->

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
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: () => ({
        data: null,
        form: useForm({
            cbc: false,
            urinalysis: false,
            chestxray: false,
            fecalysis: false,
            drugtest: false,
            psychological: false,
            neuropsychiatric: false,
            nolabneeded: false,
            purpose: null,
            purpose_sport: null,
            specific_purpose: null,
            remarks: null,
            physician: null,
            is_fit: null,
        }),
        physicians: [],
        purposes: [
            {id:1,name:'Pre-enrolment Medical Certification'},
            {id:2,name:'Educational tour/trip; seminar/convention'},
            {id:3,name:'Medical Requirement for On-the-job Training (OJT)'},
            {id:4,name:'Pre-participation Sports Clearance: Sports/Activity'},
            {id:5,name:'Others: Please Specify'},
        ],
        action: 'store'
    }),
    mounted() {
        this.data = this.$page.props.data.data;
        this.form.cbc = !!this.data.hematology_count;
        this.form.urinalysis = !!this.data.urinalysis_count;
        this.form.chestxray = !!this.data.xray_count;
        this.form.fecalysis = !!this.data.fecalysis_count;
        this.form.drugtest = !!this.data.drug_test;
        this.form.psychological = !!this.data.psychological;
        this.form.neuropsychiatric = !!this.data.neuropsychiatric;
        this.form.nolabneeded = !!this.data.no_lab_needed;
    },
    methods: {
        formattedFullName(data) {
            return `${data.first_name} ${data.middle_name?data.middle_name:''} ${data.last_name} ${data.suffix?data.suffix:''}`;
        },
        formattedDate(date) {
            return new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        },
        //allow only one purpose
        changePurpose(id) {
            this.form.purpose = id;
        }
    },
}
</script>
