<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.urinalysis.index"
                 :update-link="data? route('api.urinalysis.update', data.id): null"
                 :store-link="route('api.urinalysis.store')"
                 :delete-link="data? route('api.urinalysis.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-4 gap-1">
                <InputText v-model.number="form.infirmary_id" label="Infirmary No." type="number" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                <InputText v-model.number="form.age" label="Age" type="number" :errorMsg="form.errors.age" @input="form.errors['age'] = null" />
                <RadioButton v-model="form.sex" label="Sex" :options="sexes" :errorMsg="form.errors.sex" @input="form.errors['sex'] = null" />
                <InputText v-model="form.or_no" label="OR No." :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                <SelectElement v-model="form.rqst_physician" label="Requesting Physician" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
                <InputText v-model="form.hospital_no" label="Hospital No." :errorMsg="form.errors.hospital_no" @input="form.errors['hospital_no'] = null" />
                <InputText v-model="form.ward" label="Ward" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
            </div>
            <!--end of header form-->
            <!--urinalysis body form-->
            <div class="grid grid-cols-4 gap-1">
                <InputText v-model="form.color" label="Color" :errorMsg="form.errors.color" @input="onFocusClearError('color')" />
                <InputText v-model="form.clarity" label="Clarity" :errorMsg="form.errors.clarity" @input="onFocusClearError('clarity')" />
                <InputText v-model="form.ph" label="pH" type="number" step="0.1" :errorMsg="form.errors.ph" @input="onFocusClearError('ph')" />
                <InputText v-model="form.specific_gravity" type="number" step="0.1" label="Specific Gravity" :errorMsg="form.errors.specific_gravity" @input="onFocusClearError('specific_gravity')" />
                <InputText v-model="form.albumin" label="Protein" :errorMsg="form.errors.albumin" @input="onFocusClearError('albumin')" />
                <InputText v-model="form.glucose" label="Glucose" :errorMsg="form.errors.glucose" @input="onFocusClearError('glucose')" />
                <InputText v-model="form.blood" label="Blood" :errorMsg="form.errors.blood" @input="onFocusClearError('blood')" />
                <InputText v-model="form.leukocytes" label="Leukocytes" :errorMsg="form.errors.leukocytes" @input="onFocusClearError('leukocytes')" />
                <InputText v-model="form.nitrite" label="Nitrite" :errorMsg="form.errors.nitrite" @input="onFocusClearError('nitrite')" />
                <InputText v-model="form.bilirubin" label="Bilirubin" :errorMsg="form.errors.bilirubin" @input="onFocusClearError('bilirubin')" />
                <InputText v-model="form.urobilinogen" label="Urobilinogen" :errorMsg="form.errors.urobilinogen" @input="onFocusClearError('urobilinogen')" />
                <InputText v-model="form.ketones" label="Ketones" :errorMsg="form.errors.ketones" @input="onFocusClearError('ketones')" />
                <InputText v-model="form.epithelial_cells" label="Epithelial Cells" :errorMsg="form.errors.epithelial_cells" @input="onFocusClearError('epithelial_cells')" />
                <InputText v-model="form.bacteria" label="Bacteria" :errorMsg="form.errors.bacteria" @input="onFocusClearError('bacteria')" />
                <InputText v-model="form.amorphous_urates" label="Amorphous Urates" :errorMsg="form.errors.amorphous_urates" @input="onFocusClearError('amorphous_urates')" />
                <InputText v-model="form.amorphous_phosphates" label="Amorphous Phosphates" :errorMsg="form.errors.amorphous_phosphates" @input="onFocusClearError('amorphous_phosphates')" />
                <InputText v-model="form.mucous_threads" label="Mucus Threads" :errorMsg="form.errors.mucous_threads" @input="onFocusClearError('mucous_threads')" />
                <InputText v-model="form.crystals" label="Crystals" :errorMsg="form.errors.crystals" @input="onFocusClearError('crystals')" />
                <InputText v-model="form.cast" label="Cast" :errorMsg="form.errors.cast" @input="onFocusClearError('cast')" />
            </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-2">
                <SelectElement v-model="form.medical_technologist" label="Medical Technologist" :options="physicians" :errorMsg="form.errors.medical_technologist" @input="form.errors['medical_technologist'] = null" />
                <SelectElement v-model="form.pathologist" label="Pathologist" :options="physicians" :errorMsg="form.errors.pathologist" @input="form.errors['pathologist'] = null" />
            </div>
            <InputText v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
            <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of urinalysis footer form-->
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import CancelButton from "@/Components/Generic/Buttons/CancelButton.vue";
import ClearButton from "@/Components/Generic/Buttons/ClearButton.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
import DeleteButton from "@/Components/Generic/Buttons/DeleteButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus } from "@/Legends/legends";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                // urinalysis record
                infirmary_id: null,
                age: 22,
                sex: 'male',
                ward: 'OP',
                or_no: null,
                rqst_physician: 2,
                medical_technologist: 2,
                pathologist: 3,
                hospital_no: 901816,
                //urinalysis
                color: null,
                clarity: null,
                ph: null,
                specific_gravity: null,
                albumin: null,
                glucose: null,
                blood: null,
                leukocytes: null,
                nitrite: null,
                bilirubin: null,
                urobilinogen: null,
                ketones: null,
                wbc: null,
                rbc: null,
                epithelial_cells: null,
                bacteria: null,
                amorphous_urates: null,
                amorphous_phosphates: null,
                mucous_threads: null,
                crystals: null,
                cast: null,
                remarks: null,
                status: null,
            }),
            statuses: RecordStatus,
            bloodTypes: BloodType,
            sexes: Sex,
            data: null,
            physicians: [],
            formTitle: null,
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Urinalysis Record';
        }
        else {
            this.formTitle = 'Create Urinalysis Record';
            this.form.infirmary_id = this.$page.props.last_client_id;
        }

    }
};
</script>

