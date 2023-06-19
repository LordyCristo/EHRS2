<template>
    <Laboratory title="Medical Records">
        <div v-if="data" class="flex flex-col p-10 mx-10">
            <form @submit.prevent="submit">
                <div id="printable">
                    <ViewHeader>MEDICAL CERTIFICATE</ViewHeader>
                    <div v-if="data" class="grid grid-rows-3 gap-2 mb-5">
                        <ViewField label="Laboratory Requirements"/>
                        <div class="grid grid-cols-2">
                            <Checkbox v-model="form.cbc" :errorMsg="form.errors.cbc" label="Complete Blood Count"/>
                            <Checkbox v-model="form.urinalysis" :errorMsg="form.errors.urinalysis" label="Urinalysis"/>
                            <Checkbox v-model="form.chest_xray" :errorMsg="form.errors.chest_xray" label="Chest X-ray"/>
                            <Checkbox v-model="form.fecalysis" :errorMsg="form.errors.fecalysis" label="Fecalysis"/>
                            <Checkbox v-model="form.drug_test" :errorMsg="form.errors.drug_test" label="Drug Test"/>
                            <Checkbox v-model="form.psychological" :errorMsg="form.errors.psychological"
                                      label="Psychological"/>
                            <Checkbox v-model="form.neuropsychiatric" :errorMsg="form.errors.neuropsychiatric"
                                      label="Neuropsychiatric"/>
                            <Checkbox v-model="form.nolabneeded" :errorMsg="form.errors.nolabneeded"
                                      label="No Lab Needed"/>
                        </div>
                        <p>This is to certify that I have seen and examined Mr./Miss <b
                            class="underline">{{ formattedFullName(data) }}</b>that he/she is physically and/or
                            medically:
                            <RadioButton v-model="form.is_fit" :errorMsg="form.errors.is_fit"
                                         :options="[{id:1,name:'fit'},{id:0,name:'unfit'},]" @input="form.errors['is_fit'] = null"/>
                        </p>
                        <ViewField label="Purpose"/>
                        <InputError :message="form.errors.purpose"/>
                        <div :class="{'border border-red-300': form.errors.purpose}"
                             @input="form.errors['purpose'] = null"
                             class="grid grid-rows-5 p-2 rounded-md">
                            <div v-for="option in purposes" :key="option.id" class="whitespace-nowrap">
                                <input :id="'pur' + '-' + option.id" :checked="option.id === form.purpose" :name="option.name" :value="option.id"
                                       type="radio" @click="changePurpose(option.id)"/>
                                {{ option.name }}
                            </div>
                        </div>
                        <InputText v-if="form.purpose === 4" v-model="form.purpose_sport" :errorMsg="form.errors.purpose_sport"
                                   label="Specify Sport"/>
                        <InputText v-if="form.purpose === 5" v-model="form.specific_purpose" :errorMsg="form.errors.specific_purpose"
                                   label="Specify Purpose"/>

                        <InputTextArea v-model="form.remarks" :errorMsg="form.errors.remarks" label="Remarks" @input="form.errors['remarks'] = null"/>
                        <p>
                            I have examined the above-named patient and completed the evaluation. The patient does not
                            present apparent clinical contraindications. However, if conditions arise after the
                            student/employee/staff/faculty have been cleared, the physician may rescind the clearance
                            until the problem is resolved.
                        </p>
                        <p>
                            <b>Physician:</b>
                            <InputTextAuto v-model="form.physician_id" :errorMsg="form.errors.physician_id"
                                           @change="form.errors.physician_id = null"
                                           :options="physicians"/>
                            <ViewField :value="formattedDate()" label="Date Issued"/>
                        </p>

                    </div>
                    <div v-else class="text-center">
                        <span>Unable to retrieve Medical Data</span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save & Print</SubmitButton>
                </div>
            </form>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputError from "@/Components/Generic/Forms/InputError.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";
import axios from "axios";
import {pushNotification} from "@/Components/Generic/Modals/NotifBanner.vue";

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
            {id: 1, name: 'Pre-enrolment Medical Certification'},
            {id: 2, name: 'Educational tour/trip; seminar/convention'},
            {id: 3, name: 'Medical Requirement for On-the-job Training (OJT)'},
            {id: 4, name: 'Pre-participation Sports Clearance: Sports/Activity'},
            {id: 5, name: 'Others: Please Specify'},
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
            return `${data.first_name} ${data.middle_name ? data.middle_name : ''} ${data.last_name} ${data.suffix ? data.suffix : ''}`;
        },
        formattedDate(date) {
            return new Date().toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'});
        },
        //allow only one purpose
        changePurpose(id) {
            this.form.purpose = id;
        },
        submit() {
            if (this.action === 'store') {
                this.storeForm();
            } else if (this.action === 'update') {
                this.updateForm();
            }
        },
        async storeForm() {
            await axios.post(route('api.certificate.store'), this.form)
                .then(res => {
                    pushNotification(res.data.notification);
                    this.print('printable');
                })
                .catch((error) => {
                    this.form.errors = error.response.data.errors;
                    console.log(error.response.data.errors);
                });
        },
        updateForm() {
            axios.put(route('api.certificate.store'), this.form)
                .then(res => {
                    pushNotification(res.data.notification);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                });
        },
        async fetchData() {
            await axios.get(route('api.certificate.show', this.data.id))
                .then(res => {
                    this.data = res.data;
                    this.form = useForm(this.data);
                })
        },
        print(sectionID) {
            // get the ID of the section to be printed
            let section = document.getElementById(sectionID)
            // set the ID of the section to match CSS @media print rules
            section.setAttribute("id", "printThis")
            // print the section
            window.print();
            // set back the ID of the section to what it was...
            section.setAttribute("id", sectionID)
        }
    },

}
</script>
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #printThis, #printThis * {
        visibility: visible;
    }

    #printThis {
        position: absolute;
        left: 0;
        top: 0;
        padding: 2rem;
    }

    #printThis input{
        box-shadow: none;
    }
}
</style>

