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
                <InputTextAuto v-model.number="form.infirmary_id" label="Infirmary No." :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                <InputTextAuto v-model="form.or_no" label="OR No." :options="or_nos" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                <InputText v-model="form.ward" label="Ward" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
            </div>
            <!--end of header form-->
            <!--hematology body form-->
            <div class="my-2 border-y py-5">
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
                <div class="grid grid-cols-2">
                    <InputTextArea v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
                </div>
            </div>
            <!--end of hematology body form-->
            <!--hematology footer form-->
            <div class="grid grid-cols-3">
                <SelectElement v-model="form.rqst_physician" label="Requesting Physician" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
                <SelectElement v-model="form.medical_technologist" label="Medical Technologist" :options="physicians" :errorMsg="form.errors.medical_technologist" @input="form.errors['medical_technologist'] = null" />
                <SelectElement v-model="form.pathologist" label="Pathologist" :options="physicians" :errorMsg="form.errors.pathologist" @input="form.errors['pathologist'] = null" />
            </div>

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
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
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
                infirmary_id: null,
                rqst_physician: 2,
                medical_technologist: 2,
                pathologist: 3,
                or_no: null,
                ward: 'OP',
                status: null,
                //hematology
                hemoglobin: 0.5,
                hematocrit: 0.3,
                wbc: 0.3,
                rbc: 0.1,
                platelet_count: 0.2,
                segmenters: 0.5,
                lymphocyte: 0.8,
                monocyte: 1.0,
                blood_type: 'O+',
                remarks: null,
            }),
            statuses: RecordStatus,
            bloodTypes: BloodType,
            data: null,
            physicians: [],
            or_nos: [],
            clients: [],
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
        this.clients = this.$page.props.clients.data;
        this.or_nos = this.$page.props.or_nos.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Hematology Record';
        }
        else {
            this.formTitle = 'Create Hematology Record';
            this.form.infirmary_id = this.$page.props.last_client_id;
        }

    }
};
</script>

