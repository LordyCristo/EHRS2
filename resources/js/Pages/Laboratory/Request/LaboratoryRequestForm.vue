<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.requests.index"
                 :update-link="data? route('api.laboratory.requests.update', data.id): null"
                 :store-link="route('api.laboratory.requests.store')"
                 :delete-link="data? route('api.laboratory.requests.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-2 gap-1">
                <DisplayValue label="Date" :value="formatDate(form.created_at)" />
                <SelectElement v-model.number="form.ward" autofocus label="Ward" :required="true" :options="wards" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
            </div>
            <div class="grid grid-cols-1 gap-1">
                <InputTextAuto v-model.number="form.infirmary_id" autofocus :combinedNameId="true" label="Patient" :required="true" :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
            </div>
            <div v-if="selctedClient" class="flex justify-between gap-1">
                <ViewField label="Infirmary ID" :value="selctedClient.id" class="text-sm" />
                <ViewField label="Sex" :value="selctedClient.sex" class="text-sm capitalize" />
                <ViewField label="Age" :value="selctedClient.age" class="text-sm" />
            </div>
            <!--end of header form-->
            <!--urinalysis body form-->
            <div class="my-2 border-y py-5">
                <div class="grid grid-cols-2 gap-2">
                    <Checkbox v-model="form.urinalysis" label="Urinalysis"/>
                    <Checkbox v-model="form.stool_exam" label="Stool Exam"/>
                    <Checkbox v-model="form.cbc" label="CBC"/>
                    <Checkbox v-model="form.platelet_count" label="Platelet Count"/>
                    <Checkbox v-model="form.bleeding_clottting_time" label="Bleeding & Clotting Time"/>
                    <Checkbox v-model="form.hemoglobin" label="Hemoglobin"/>
                    <Checkbox v-model="form.hematocrit" label="Hematocrit"/>
                    <Checkbox v-model="form.wbc_diff_count" label="WBC & Diff. ct."/>
                    <Checkbox v-model="form.blood_typing" label="Blood Typing"/>
                    <Checkbox v-model="form.pregnancy_test" label="Pregnancy Test"/>
                    <Checkbox v-model="form.afb_straining" label="AFB Staining"/>
                </div>
                <div class="flex flex-col">
                    <Checkbox v-model="form.is_other" label="Others"/>
                    <InputTextArea v-if="form.is_other" v-model="form.other_value" :errorMsg="form.errors.other_value" @input="form.errors['other_value'] = null" />
                </div>
            </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-1">
                <SelectElement v-model="form.physician" label="Requesting Physician" :required="true" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
            </div>
            <div class="grid grid-cols-1">
                <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :required="true" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            </div>
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
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import {
    InOutPatient,
    Lab_Group_1,
    Lab_Group_2,
    Lab_Group_3,
    Lab_Group_4,
    Lab_Group_5,
    WardType
} from "@/Legends/legends";
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import ViewFieldBelow from "@/Components/Generic/Forms/ViewFieldBelow.vue";
import DisplayValue from "@/Components/Generic/Forms/DisplayValue.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
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
                infirmary_id: null,
                ward: null,
                physician: null,
                urinalysis: null,
                stool_exam: null,
                cbc: null,
                platelet_count: null,
                bleeding_clottting_time: null,
                hemoglobin: null,
                hematocrit: null,
                wbc_diff_count: null,
                blood_typing: null,
                pregnancy_test: null,
                afb_straining: null,
                is_other: null,
                other_value: null,
                status: null,
                created_at: null,
            }),
            statuses: RecordStatus,
            wards: WardType,
            data: null,
            physicians: [],
            or_nos: [],
            clients: [],
            selctedClient: null,
            formTitle: null,
        };
    },
    watch:{
        'form.infirmary_id': function (val){
            this.selctedClient = this.clients.find(client => client.id === val);
        }
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        dateNow() {
            return new Date().toISOString().slice(0, 10);
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.clients = this.$page.props.clients.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Laboratory Request';
        }
        else {
            this.formTitle = 'Create Laboratory Request';
            this.form.physician = this.physicians[0].id;
            this.form.status = this.statuses[0].id;
            this.form.created_at = this.dateNow();
        }

    }
};
</script>

