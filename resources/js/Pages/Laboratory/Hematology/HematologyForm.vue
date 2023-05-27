<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.hematology.index"
                 :update-link="data? route('api.hematology.update', data.id): null"
                 :store-link="route('api.hematology.store')"
                 :delete-link="data? route('api.hematology.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-4 gap-1">
                <InputText v-model.number="form.client_id" label="Patient" type="number" :errorMsg="form.errors.client_id" @input="form.errors['client_id'] = null" />
                <InputText v-model.number="form.age" label="Age" type="number" :errorMsg="form.errors.age" @input="form.errors['age'] = null" />
                <RadioButton v-model="form.sex" label="Sex" :options="sexes" :errorMsg="form.errors.sex" @input="form.errors['sex'] = null" />
                <InputText v-model="form.or_no" label="OR No." :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                <SelectElement v-model="form.rqst_physician" label="Requesting Physician" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
                <InputText v-model="form.hospital_no" label="Hospital No." :errorMsg="form.errors.hospital_no" @input="form.errors['hospital_no'] = null" />
                <InputText v-model="form.ward" label="Ward" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
            </div>
            <!--end of header form-->
            <!--hematology body form-->
            <div class="grid grid-cols-4 gap-1">
                <InputText v-model.number="form.hemoglobin" label="Hemoglobin" type="number" :step="0.01" :errorMsg="form.errors.hemoglobin" @input="onFocusClearError('hemoglobin')" />
                <InputText v-model.number="form.hematocrit" label="Hematocrit" type="number" :step="0.01" :errorMsg="form.errors.hematocrit" @input="onFocusClearError('hematocrit')" />
                <InputText v-model.number="form.wbc" label="WBC" type="number" :step="0.01" :errorMsg="form.errors.wbc" @input="onFocusClearError('wbc')" />
                <InputText v-model.number="form.rbc" label="RBC" type="number" :step="0.01" :errorMsg="form.errors.rbc" @input="onFocusClearError('rbc')" />
                <InputText v-model.number="form.platelet_count" label="Platelet Count" type="number" :step="0.01" :errorMsg="form.errors.platelet_count" @input="onFocusClearError('platelet_count')" />
                <InputText v-model.number="form.segmenters" label="Segmenters" type="number" :step="0.01" :errorMsg="form.errors.segmenters" @input="onFocusClearError('segmenters')" />
                <InputText v-model.number="form.lymphocyte" label="Lymphocytes" type="number" :step="0.01" :errorMsg="form.errors.lymphocyte" @input="onFocusClearError('lymphocytes')" />
                <InputText v-model.number="form.monocyte" label="Monocytes" type="number" :step="0.01" :errorMsg="form.errors.monocyte" @input="onFocusClearError('monocyte')" />
                <SelectElement v-model.number="form.blood_type" label="Blood Type" :options="bloodTypes" :errorMsg="form.errors.blood_type" @input="onFocusClearError('blood_type')" />
            </div>
            <!--end of hematology body form-->
            <!--hematology footer form-->
            <InputText v-model.number="form.diagnosis" label="Diagnosis" :errorMsg="form.errors.diagnosis" @input="onFocusClearError('diagnosis')" />
            <InputText v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
            <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of hematology footer form-->
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
                // hematology record
                client_id: null,
                age: null,
                sex: null,
                ward: null,
                or_no: null,
                rqst_physician: null,
                hospital_no: null,
                //hematology
                hemoglobin: null,
                hematocrit: null,
                wbc: null,
                rbc: null,
                platelet_count: null,
                segmenters: null,
                lymphocyte: null,
                monocyte: null,
                blood_type: null,
                diagnosis: null,
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
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data[0];
            this.form = useForm(this.data);
            this.formTitle = 'Update Hematology Record';
        }
        else {
            this.form.status = 'Processing';
            this.formTitle = 'Create Hematology Record';
        }

    }
};
</script>

