<template>
    <form @submit.prevent="submit">
        <!--header form-->
        <div class="grid grid-cols-4 gap-1">
            <InputText v-model.number="form.client_id" label="Patient" type="number" :errorMsg="form.errors.client_id" @input="onFocusClearError('client_id')" />
            <InputText v-model.number="form.age" label="Age" type="number" :errorMsg="form.errors.age" @input="onFocusClearError('age')" />
            <RadioButton v-model="form.sex" label="Sex" :options="sexes" :errorMsg="form.errors.sex" @input="onFocusClearError('sex')" />
            <InputText v-model="form.or_no" label="OR No." :errorMsg="form.errors.or_no" @input="onFocusClearError('or_no')" />
            <InputText v-model="form.rqst_physician" label="Requesting Physician" :errorMsg="form.errors.rqst_physician" @input="onFocusClearError('rqst_physician')" />
            <InputText v-model="form.hospital_no" label="Hospital No." :errorMsg="form.errors.hospital_no" @input="onFocusClearError('hospital_no')" />
            <InputText v-model="form.ward" label="Ward" :errorMsg="form.errors.ward" @input="onFocusClearError('ward')" />
        </div>
        <!--end of header form-->
    </form>
    <form @submit.prevent="submit">
        <!--hematology body form-->
        <div class="grid grid-cols-4 gap-1">
            <InputText v-model.number="form.hemoglobin" label="Hemoglobin" type="number" :step="0.1" :errorMsg="form.errors.hemoglobin" @input="onFocusClearError('hemoglobin')" />
            <InputText v-model.number="form.hematocrit" label="Hematocrit" type="number" :step="0.1" :errorMsg="form.errors.hematocrit" @input="onFocusClearError('hematocrit')" />
            <InputText v-model.number="form.wbc" label="WBC" type="number" :step="0.1" :errorMsg="form.errors.wbc" @input="onFocusClearError('wbc')" />
            <InputText v-model.number="form.rbc" label="RBC" type="number" :step="0.1" :errorMsg="form.errors.rbc" @input="onFocusClearError('rbc')" />
            <InputText v-model.number="form.platelet_count" label="Platelet Count" type="number" :step="0.1" :errorMsg="form.errors.platelet_count" @input="onFocusClearError('platelet_count')" />
            <InputText v-model.number="form.segmenters" label="Segmenters" type="number" :step="0.1" :errorMsg="form.errors.segmenters" @input="onFocusClearError('segmenters')" />
            <InputText v-model.number="form.lymphocyte" label="Lymphocytes" type="number" :step="0.1" :errorMsg="form.errors.lymphocyte" @input="onFocusClearError('lymphocytes')" />
            <InputText v-model.number="form.monocyte" label="Monocytes" type="number" :step="0.1" :errorMsg="form.errors.monocyte" @input="onFocusClearError('monocyte')" />
            <SelectElement v-model.number="form.blood_type" label="Blood Type" :options="bloodTypes" :errorMsg="form.errors.blood_type" @input="onFocusClearError('blood_type')" />
        </div>
        <!--end of hematology body form-->
        <!--hematology footer form-->
        <InputText v-model.number="form.diagnosis" label="Diagnosis" :errorMsg="form.errors.diagnosis" @input="onFocusClearError('diagnosis')" />
        <InputText v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
        <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
        <!--end of hematology footer form-->


        <div class="flex items-center justify-between mt-4">
            <template v-if="action === 'update'">
                <DeleteButton @click="deleteForm" >Delete</DeleteButton>
                <CancelButton  @click="cancelForm">Cancel</CancelButton>
            </template>
            <ClearButton v-else @click="clearForm">Clear</ClearButton>
            <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
        </div>
    </form>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import CancelButton from "@/Components/Generic/Buttons/CancelButton.vue";
import ClearButton from "@/Components/Generic/Buttons/ClearButton.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
import DeleteButton from "@/Components/Generic/Buttons/DeleteButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus } from "@/Legends/legends";
export default {
    props: {
        errors: [Object, Function],
        action: String,
        data: {
            type: Object,
            required: false,
            default: [],
        },
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
        };
    },
    methods: {
        submit() {
            if (this.action === 'store') {
                this.store();
            } else if (this.action === 'update') {
                this.update();
            } else {
                this.goBackToIndex();
            }
        },
        goBackToIndex(){
            this.$router.push('hematology.index');
            this.$router.back() // go back to the hematology index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
            this.setDefaults();
        },
        setDefaults(){
            this.form.status = 'Pending';
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.hematology.store'), this.form)
                .then(response => {
                    if (response && response.status) {
                        console.log(response);
                        this.goBackToIndex();
                    } else {
                        // Handle the case when the response or its status is undefined
                        this.printError("Invalid response received");
                    }
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.hematology.update', this.data.id), this.form)
                .then( response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        printError(error){
            if(typeof error.response.data.errors === 'object'){
                if (error.response.status === 422) { // error code for validation errors.
                    console.log('Validation errors:', error.response.data.errors);
                    this.form.errors = error.response.data.errors;
                }
                else if (error.response.status === 500) { // error code for server errors.
                    console.log('Server error:', error.response.data);
                }
                else if (error.response.status === 404) { // error code for not found data.
                    console.log('Not found:', error.response.data);
                }
                else {
                    console.log('Error:', error.response.data);
                    console.log(this.$page.props.user);
                }
            }else{
                console.log(error);
            }
        },
        deleteForm(){
            if (confirm(`Are you sure you want to delete this record?`)) {
                axios.delete(route('api.hematology.destroy', this.data.id))
                    .then( () => {
                        this.goBackToIndex();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        onFocusClearError(field){
            this.form.errors[field] = null;
        }
    },
    mounted() {
        if (this.action === 'update')
            this.form = useForm(this.data);
        else
            this.setDefaults();
    }
};
</script>
