<template>
    <Head title="Public Client Form" />
    <landing-nav-bar></landing-nav-bar>
    <div class="flex items-center justify-center py-10 w-full">
        <div class="border p-5 rounded-md shadow-md">
            <FormTitleHeader :link="route('login')">
                <slot name="formTitle" />
            </FormTitleHeader>
            <div class="flex items-center justify-end">
                <div>
                    <input type="checkbox" v-model="stayOnPage" @click="stayOnPageChange" class="rounded-full">
                    <label for="stayOnPage" class="ml-2 text-sm text-gray-500">Stay on page</label>
                </div>
            </div>
            <form @submit.prevent="submit" id="printableFormContent">
                {{ formTitle }}
                <div class="grid grid-cols-1">
                    <div class="grid grid-cols-4">
                        <InputText v-model="form.infirmary_id" label="Infirmary No." required :errorMsg="form.errors.infirmary_id" @input="onFocusClearError('infirmary_id');" />
                        <InputText v-model="form.id_number" label="Student ID No." :errorMsg="form.errors.id_number" autofocus @input="onFocusClearError('id_number'); formatIdNumber($event); " />
                        <Select v-model="form.client_type_id" label="Client Type" required :options="client_types" :errorMsg="form.errors.client_type_id" @input="onFocusClearError('client_type_id')" />
                    </div>
                    <div class="grid grid-cols-4">
                        <InputText v-model.trim="form.first_name" label="First Name" required :errorMsg="form.errors.first_name" @input="onFocusClearError('first_name')" />
                        <InputText v-model.trim="form.middle_name" label="Middle Name" :errorMsg="form.errors.middle_name" @input="onFocusClearError('middle_name')" />
                        <InputText v-model.trim="form.last_name" label="Last Name" required :errorMsg="form.errors.last_name" @input="onFocusClearError('last_name')" />
                        <InputText v-model.trim="form.suffix" label="Suffix" :errorMsg="form.errors.suffix" @input="onFocusClearError('suffix')" />
                    </div>
                    <div class="grid grid-cols-4">
                        <Datepicker v-model="form.birthdate" label="Birthdate" required :errorMsg="form.errors.birthdate" @change="computeAge()" @input="onFocusClearError('birthdate')" />
                        <InputText v-model.number="form.age" label="Age" required type="number" :errorMsg="form.errors.age" @input="onFocusClearError('age')" />
                        <RadioButton v-model="form.sex" label="Sex" :options="sexes" required :errorMsg="form.errors.sex" @input="onFocusClearError('sex')" />
                        <Select v-model="form.civil_status" label="Civil Status" required :options="civil_statuses" :errorMsg="form.errors.civil_status" @input="onFocusClearError('civil_status')" />
                    </div>
                    <div class="grid grid-cols-2">
                        <InputText v-model.trim="form.email_address" label="Email" required type="text" :errorMsg="form.errors.email_address" @input="onFocusClearError('email_address')" />
                        <InputText v-model.trim="form.phone" label="Phone" type="tel" required :errorMsg="form.errors.phone" @input="onFocusClearError('phone')" />
                    </div>
                    <div class="grid grid-cols-2">
                        <InputText v-model.trim="form.home_address" label="Home Address" required type="text" :errorMsg="form.errors.home_address" @input="onFocusClearError('home_address')" />
                        <InputText v-model.trim="form.curr_address" label="Current Address" required type="text" :errorMsg="form.errors.curr_address" @input="onFocusClearError('curr_address')" />
                    </div>
                    <div class="grid grid-cols-2">
                        <InputTextAuto v-model="form.program_id" label="Degree Program" :options="degree_programs" :errorMsg="form.errors.program_id" @input="onFocusClearError('program_id')" />
                        <Select v-model="form.year_lvl" label="Year Level" :options="year_levels" :errorMsg="form.errors.year_lvl" @input="onFocusClearError('year_lvl')" />
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <template v-if="action === 'update'">
                        <DeleteButton @click="deleteForm">Delete</DeleteButton>
                        <CancelButton @click="cancelForm">Cancel</CancelButton>
                    </template>
                    <ClearButton v-else @click="clearForm">Clear</ClearButton>
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
                </div>
            </form>
        </div>
    </div>
    <landing-footer></landing-footer>
</template>
<script setup>
import LandingFooter from "@/Components/LandingFooter.vue";
import LandingNavBar from "@/Components/LandingNavBar.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import DeleteButton from "@/Components/Generic/Buttons/DeleteButton.vue";
import CancelButton from "@/Components/Generic/Buttons/CancelButton.vue";
import ClearButton from "@/Components/Generic/Buttons/ClearButton.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
import {onMounted, ref} from "vue";
import FormTitleHeader from "@/Components/Generic/Forms/FormTitleHeader.vue";
</script>

<script>
import { pushNotification } from "@/Components/Generic/Modals/NotifBanner.vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
import { router } from '@/router';
import axios from "axios";
export default {
    data() {
        return {
            stayOnPage: false,
            action: 'store',
            sexes: Sex,
            civil_statuses: CivilStatus,
            year_levels: YearLevel,
            data: null,
            degree_programs: null,
            client_types: null,
            last_client_id: null,
            formTitle: null,
            form: useForm({
                infirmary_id: null,
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
        onFocusClearError(field) {
            this.form.errors[field] = null;
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
        submit(){
            if (this.action === 'store') {
                this.storeForm();
            }else {
                this.goBackToIndex();
            }
        },
        cancelForm(){
            this.form.reset();
        },
        clearForm(){
            this.form.reset();
            this.form.errors = {};
        },
        storeForm(){
            console.log(this.form);
            axios
                .post(route('api.public.client.store'), this.form)
                .then(res => {
                    console.log(res);
                    this.goBackToIndex(res);
                })
                .catch(this.printError);
        },
        printError(error){
            const notif = {
                'id': error.code,
                'show': true,
                'type': 'warning',
                'message': error.message,
            }
            console.log(error);
            pushNotification(notif);
            // error code for validation errors.
            if (typeof error.response != 'undefined' && error.response.status === 422)
                this.form.errors = error.response.data.errors;

        },
        goBackToIndex(response){
            if(typeof response != 'undefined')
                pushNotification(response.data.notification);
            else
                console.log(response);
            if (this.stayOnPage) {
                // reload the page to get the updated data using the same url but without loading the page.
                location.reload();
            } else {
                router.push({name: 'dashboard'});
                router.back();
            }
        },
        stayOnPageChange(){
            this.stayOnPage = !this.stayOnPage;
            // save the value to local storage
            localStorage.setItem('stayOnPage', this.stayOnPage.toString());
        }
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Client Details';
            this.data = this.$page.props.data.data;
        }else{
            this.formTitle = 'Register New Client';
            this.form.infirmary_id = this.$page.props.last_client_id.infirmary_id? this.$page.props.last_client_id.infirmary_id + 1: 1;
        }

        this.degree_programs = this.$page.props.degree_programs;
        this.client_types = this.$page.props.client_types;
        // get the value from local storage
        this.stayOnPage = localStorage.getItem('stayOnPage') === 'true';

    }
};
</script>
