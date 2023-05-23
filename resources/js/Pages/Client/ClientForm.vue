<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1">
            <div class="grid grid-cols-4">
                <InputText v-model="form.id_number" label="ID #" :errorMsg="form.errors.id_number" autofocus @input="onFocusClearError('id_number'); formatIdNumber($event); " />
                <Select v-model="form.client_type_id" label="Client Type" :options="client_types" :errorMsg="form.errors.client_type_id" @input="onFocusClearError('client_type_id')" />
            </div>
            <div class="grid grid-cols-4">
                <InputText v-model.trim="form.first_name" label="First Name" :errorMsg="form.errors.first_name" @input="onFocusClearError('first_name')" />
                <InputText v-model.trim="form.middle_name" label="Middle Name" :errorMsg="form.errors.middle_name" @input="onFocusClearError('middle_name')" />
                <InputText v-model.trim="form.last_name" label="Last Name" :errorMsg="form.errors.last_name" @input="onFocusClearError('last_name')" />
                <InputText v-model.trim="form.suffix" label="Suffix" :errorMsg="form.errors.suffix" @input="onFocusClearError('suffix')" />
            </div>
            <div class="grid grid-cols-4">
                <Datepicker v-model="form.birthdate" label="Birthdate" :errorMsg="form.errors.birthdate" @change="computeAge()" @input="onFocusClearError('birthdate')" />
                <InputText v-model.number="form.age" label="Age" type="number" :errorMsg="form.errors.age" @input="onFocusClearError('age')" />
                <RadioButton v-model="form.sex" label="Sex" :options="sexes" :errorMsg="form.errors.sex" @input="onFocusClearError('sex')" />
                <Select v-model="form.civil_status" label="Civil Status" :options="civil_statuses" :errorMsg="form.errors.civil_status" @input="onFocusClearError('civil_status')" />
            </div>
            <div class="grid grid-cols-2">
                <InputText v-model.trim="form.email_address" label="Email" type="text" :errorMsg="form.errors.email_address" @input="onFocusClearError('email_address')" />
                <InputText v-model.trim="form.phone" label="Phone" type="tel" :errorMsg="form.errors.phone" @input="onFocusClearError('phone')" />
            </div>
            <div class="grid grid-cols-2">
                <InputText v-model.trim="form.home_address" label="Home Address" type="text" :errorMsg="form.errors.home_address" @input="onFocusClearError('home_address')" />
                <InputText v-model.trim="form.curr_address" label="Current Address" type="text" :errorMsg="form.errors.curr_address" @input="onFocusClearError('curr_address')" />
            </div>
            <div class="grid grid-cols-2">
                <Select v-model="form.program_id" label="Degree Program" :options="degree_programs" :errorMsg="form.errors.program_id" @input="onFocusClearError('program_id')" />
                <Select v-model="form.year_lvl" label="Year Level" :options="year_levels" :errorMsg="form.errors.year_lvl" @input="onFocusClearError('year_lvl')" />
            </div>
            <div class="flex items-center justify-between mt-4">
                <template v-if="action === 'update'">
                    <DeleteButton @click="deleteForm" >Delete</DeleteButton>
                    <CancelButton  @click="cancelForm">Cancel</CancelButton>
                </template>
                <ClearButton v-else @click="clearForm">Clear</ClearButton>
                <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
            </div>
        </div>
    </form>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import CancelButton from "@/Components/Generic/Buttons/CancelButton.vue";
import ClearButton from "@/Components/Generic/Buttons/ClearButton.vue";
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
import DeleteButton from "@/Components/Generic/Buttons/DeleteButton.vue";
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
import axios from "axios";
export default {
    props: {
        action: String,
        data: {
            type: Object,
            required: false,
            default: [],
        },
        degree_programs: Object,
        client_types: Object,
        last_client_id: [Number, String],
    },
    data() {
        return {
            sexes: Sex,
            civil_statuses: CivilStatus,
            year_levels: YearLevel,
            form: useForm({
                first_name: null,
                middle_name: null,
                last_name: null,
                suffix: null,
                birthdate: null,
                age: null,
                sex: null,
                civil_status: null,
                phone: null,
                email_address: null,
                home_address: null,
                curr_address: null,
                id_number: null,
                program_id: null,
                year_lvl: null,
                client_type_id: null,
            }),
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
            this.$router.push({name:'client.index'});
            this.$router.back() // go back to the clients index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.client.store'), this.form)
                .then(response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.client.update', this.data.id), this.form)
                .then( response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        printError(error){
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
        },
        deleteForm(){
            if (confirm(`Are you sure you want to delete this record?`)) {
                axios.delete(route('api.client.destroy', this.data.id))
                    .then( () => {
                        this.goBackToIndex();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        computeAge() {
            const birthdate = new Date(this.form.birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            const month = today.getMonth() - birthdate.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            this.form.age = age;
        },
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        formatIdNumber(event) {
            const { data, inputType } = event;
            if (data === '-' || inputType === 'deleteContentBackward' || this.form.id_number.length > 10) {
                this.form.id_number = this.form.id_number.slice(0, -1);
            }else{
                let id_number = this.form.id_number;
                if (id_number.length === 2) {
                    id_number += '-';
                } else if (id_number.length === 4) {
                    id_number += '-';
                }
                this.form.id_number = id_number;
            }
        },
    },
    mounted() {
        if (this.action === 'update')
            this.form = useForm(this.data);
    }
};
</script>
