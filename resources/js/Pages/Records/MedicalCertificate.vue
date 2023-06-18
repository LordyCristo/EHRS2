<template>
    <Laboratory title="Medical Records">
        <div class="flex flex-col p-10 mx-10 shadow-lg">
            <FormSection :data="data" :form="form" :action="action"
                         index-link="records"
                         :store-link="route('api.certificate.store')">
                <template #formBody>
                    <ViewHeader>MEDICAL CERTIFICATE</ViewHeader>
                    <div class="grid grid-rows-3 gap-2 mb-5" v-if="data">
                        <ViewField label="Laboratory Requirements"/>
                        <div class="grid grid-cols-2">
                            <Checkbox v-model="form.cbc" label="Complete Blood Count" :errorMsg="form.errors.cbc"/>
                            <Checkbox v-model="form.urinalysis" label="Urinalysis" :errorMsg="form.errors.urinalysis"/>
                            <Checkbox v-model="form.chest_xray" label="Chest X-ray" :errorMsg="form.errors.chest_xray"/>
                            <Checkbox v-model="form.fecalysis" label="Fecalysis" :errorMsg="form.errors.fecalysis"/>
                            <Checkbox v-model="form.drug_test" label="Drug Test" :errorMsg="form.errors.drug_test"/>
                            <Checkbox v-model="form.psychological" label="Psychological" :errorMsg="form.errors.psychological"/>
                            <Checkbox v-model="form.neuropsychiatric" label="Neuropsychiatric" :errorMsg="form.errors.neuropsychiatric"/>
                            <Checkbox v-model="form.nolabneeded" label="No Lab Needed" :errorMsg="form.errors.nolabneeded"/>
                        </div>
                        <p>This is to certify that I have seen and examined Mr./Miss <b class="underline">{{ formattedFullName(data) }}</b>that he/she is physically and/or medically:
                            <RadioButton v-model="form.is_fit" :errorMsg="form.errors.is_fit" :options="[{id:1,name:'fit'},{id:0,name:'unfit'},]"/>
                        </p>
                        <ViewField label="Purpose"/>
                        <InputError :message="form.errors.purpose"/>
                        <div class="grid grid-rows-5 p-2 rounded-md" :class="{'border border-red-300': form.errors.purpose}">
                            <div v-for="option in purposes" :key="option.id" class="whitespace-nowrap" >
                                <input type="radio" :id="'pur' + '-' + option.id" :name="option.name" :value="option.id"
                                       :checked="option.id === form.purpose"  @click="changePurpose(option.id)" />
                                {{ option.name }}
                            </div>
                        </div>
                        <InputText v-if="form.purpose === 4" v-model="form.purpose_sport" label="Specify Sport" :errorMsg="form.errors.purpose_sport"/>
                        <InputText v-if="form.purpose === 5" v-model="form.specific_purpose" label="Specify Purpose" :errorMsg="form.errors.specific_purpose"/>

                        <InputTextArea v-model="form.remarks" label="Remarks" :errorMsg="form.errors.remarks"/>
                        <p>
                            I have examined the above-named patient and completed the evaluation. The patient does not present apparent clinical contraindications. However, if conditions arise after the student/employee/staff/faculty have been cleared, the physician may rescind the clearance until the problem is resolved.
                        </p>
                        <p>
                            <b>Physician:</b>
                            <InputTextAuto v-model="form.physician_id" :options="physicians" :errorMsg="form.errors.physician_id"/>
                            <ViewField label="Date Issued" :value="formattedDate()"/>
                        </p>
                    </div>
                    <div v-else class="text-center">
                        <span>Unable to retrieve Medical Data</span>
                    </div>
                </template>
            </FormSection>
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
import InputError from "@/Components/Generic/Forms/InputError.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: () => ({
        data: null,
        form: useForm({
            cbc: false,
            urinalysis: false,
            chest_xray: false,
            fecalysis: false,
            drug_test: false,
            psychological: false,
            neuropsychiatric: false,
            nolabneeded: false,
            purpose: null,
            purpose_sport: null,
            specific_purpose: null,
            remarks: null,
            physician_id: null,
            is_fit: null,
            infirmary_id: null,
        }),
        purposes: [
            {id:1,name:'Pre-enrolment Medical Certification'},
            {id:2,name:'Educational tour/trip; seminar/convention'},
            {id:3,name:'Medical Requirement for On-the-job Training (OJT)'},
            {id:4,name:'Pre-participation Sports Clearance: Sports/Activity'},
            {id:5,name:'Others: Please Specify'},
        ],
        physicians: [],
        action: 'store'
    }),
    mounted() {
        this.data = this.$page.props.data.data;
        this.form.cbc = !!this.data.hematology_count;
        this.form.urinalysis = !!this.data.urinalysis_count;
        this.form.chest_xray = !!this.data.xray_count;
        this.form.fecalysis = !!this.data.fecalysis_count;
        this.form.drug_test = !!this.data.drug_test;
        this.form.psychological = !!this.data.psychological;
        this.form.neuropsychiatric = !!this.data.neuropsychiatric;
        this.form.nolabneeded = !!this.data.no_lab_needed;
        this.form.purpose = this.data.purpose;
        this.form.purpose_sport = this.data.purpose_sport;
        this.form.specific_purpose = this.data.specific_purpose;
        this.form.remarks = this.data.remarks;
        this.form.physician = this.data.physician;
        this.form.is_fit = this.data.is_fit;
        this.form.infirmary_id = this.data.infirmary_id;
        this.physicians = this.$page.props.physicians;
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
