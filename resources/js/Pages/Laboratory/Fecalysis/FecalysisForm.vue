<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.fecalysis.index"
                 :update-link="data? route('api.fecalysis.update', data.id): null"
                 :store-link="route('api.fecalysis.store')"
                 :delete-link="data? route('api.fecalysis.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-2 gap-1">
                <InputTextAuto v-model="form.infirmary_id" :required="true" :autofocus="true"  label="Infirmary No" :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                <div class="grid grid-cols-2 gap-1">
                    <InputTextAuto v-model="form.or_no" label="OR No." :options="or_nos" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                    <SelectElement v-model="form.ward" :required="true" label="Ward" :options="wards" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
                </div>
            </div>
            <!--end of header form-->
            <!--fecalysis body form-->
            <div class="my-2 border-y py-5">
                <div class="grid grid-cols-4 gap-1">
                    <InputText v-model="form.color" :required="true" label="Color" :errorMsg="form.errors.color" @input="onFocusClearError('color')" />
                    <SelectElement v-model="form.consistency" :required="true" label="Consistency" :options="Lab_Group_6" :errorMsg="form.errors.consistency" @input="onFocusClearError('consistency')" />
                    <SelectElement v-model="form.wbc" :required="true" label="WBC" :options="Lab_Group_4" :errorMsg="form.errors.wbc" @input="onFocusClearError('wbc')" />
                    <SelectElement v-model="form.rbc" :required="true" label="RBC" :options="Lab_Group_4" :errorMsg="form.errors.rbc" @input="onFocusClearError('rbc')" />
                    <InputText v-model.number="form.fat_globules" :required="true" label="Fat Globules" type="number" :step="0.01" :errorMsg="form.errors.fat_globules" @input="onFocusClearError('fat_globules')" />
                    <InputText v-model="form.ova" label="Ova" :errorMsg="form.errors.ova" @input="onFocusClearError('ova')" />
                </div>
                <!--end of fecalysis body form-->
                <!--fecalysis footer form-->
                <div class="grid grid-cols-2">
                    <InputTextArea v-model="form.others" label="Others" type="others" :errorMsg="form.errors.others" @input="onFocusClearError('others')" />
                    <input-text-area v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
                </div>
            </div>
            <div class="grid grid-cols-3 my-2">
                <SelectElement v-model="form.rqst_physician" :required="true" label="Requesting Physician" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
                <SelectElement v-model="form.medical_technologist" :required="true" label="Medical Technologist" :options="physicians" :errorMsg="form.errors.medical_technologist" @input="form.errors['medical_technologist'] = null" />
                <SelectElement v-model="form.pathologist" :required="true" label="Pathologist" :options="physicians" :errorMsg="form.errors.pathologist" @input="form.errors['pathologist'] = null" />
            </div>
            <RadioButton v-model="form.status" :required="true" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of fecalysis footer form-->
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import {Lab_Group_4, Lab_Group_6} from "@/Legends/legends";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus, WardType} from "@/Legends/legends";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                // fecalysis record
                infirmary_id: null,
                rqst_physician: 2,
                medical_technologist: 4,
                pathologist: 3,
                or_no: null,
                ward: null,
                status: null,
                //fecalysis
                color: null,
                consistency: null,
                ova: null,
                wbc: null,
                rbc: null,
                fat_globules: null,
                others: null,
                remarks: null,
            }),
            statuses: RecordStatus,
            wards: WardType,
            data: null,
            physicians: [],
            clients: [],
            or_nos: [],
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
            this.formTitle = 'Update Fecalysis Record';
        }
        else {
            this.formTitle = 'Create Fecalysis Record';
            this.form.ova = 'No Ova or parasites seen';
        }
    }
};
</script>

