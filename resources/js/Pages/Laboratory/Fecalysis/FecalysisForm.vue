<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.fecalysis.index"
                 :update-link="data? route('api.fecalysis.update', data.id): null"
                 :store-link="route('api.fecalysis.store')"
                 :delete-link="data? route('api.fecalysis.destroy', data.id): null">
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
            <!--fecalysis body form-->
            <div class="grid grid-cols-4 gap-1">
                <InputText v-model="form.color" label="Color" :errorMsg="form.errors.color" @input="onFocusClearError('color')" />
                <InputText v-model="form.consistency" label="Consistency" :errorMsg="form.errors.consistency" @input="onFocusClearError('consistency')" />
                <InputText v-model.number="form.wbc" label="WBC" type="number" :step="0.01" :errorMsg="form.errors.wbc" @input="onFocusClearError('wbc')" />
                <InputText v-model.number="form.rbc" label="RBC" type="number" :step="0.01" :errorMsg="form.errors.rbc" @input="onFocusClearError('rbc')" />
                <InputText v-model.number="form.ova" label="Ova" type="number" :step="0.01" :errorMsg="form.errors.ova" @input="onFocusClearError('ova')" />
                <InputText v-model.number="form.fat_globules" label="Fat Globules" type="number" :step="0.01" :errorMsg="form.errors.fat_globules" @input="onFocusClearError('fat_globules')" />
                <InputText v-model="form.others" label="Others" type="others" :errorMsg="form.errors.others" @input="onFocusClearError('others')" />
                <InputText v-model="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
            </div>
            <!--end of fecalysis body form-->
            <!--fecalysis footer form-->
            <div class="grid grid-cols-2">
                <SelectElement v-model="form.medical_technologist" label="Medical Technologist" :options="physicians" :errorMsg="form.errors.medical_technologist" @input="form.errors['medical_technologist'] = null" />
                <SelectElement v-model="form.pathologist" label="Pathologist" :options="physicians" :errorMsg="form.errors.pathologist" @input="form.errors['pathologist'] = null" />
            </div>
            <InputText v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
            <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of fecalysis footer form-->
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
                // fecalysis record
                infirmary_id: null,
                age: null,
                sex: null,
                ward: null,
                or_no: null,
                rqst_physician: null,
                medical_technologist: null,
                pathologist: null,
                hospital_no: null,
                //fecalysis
                color: null,
                consistency: null,
                ova: null,
                wbc: null,
                rbc: null,
                fat_globules: null,
                others: null,
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
            this.formTitle = 'Update Fecalysis Record';
        }
        else {
            this.formTitle = 'Create Fecalysis Record';
            this.form.infirmary_id = this.$page.props.last_client_id;
        }

    }
};
</script>

