<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
import InputText from '@/Components/Generic/Forms/InputText.vue';
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import Datepicker from '@/Components/Generic/Forms/Datepicker.vue';
import RadioButton from '@/Components/Generic/Forms/RadioButton.vue';
import SubmitButton from '@/Components/Generic/Buttons/SubmitButton.vue';
import ClearButton from '@/Components/Generic/Buttons/ClearButton.vue';
import ComboBox from '@/Components/Generic/Headlessui/ComboBoxAutoComplete.vue';
import SelectUI from '@/Components/Generic/Headlessui/Select.vue';
</script>

<script>
export default {
    data() {
        return {
            degree_programs: ref(Array),
            client_types: ref(Array),
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
            })
        };
    },
    methods: {
        submit() {
            this.form.post(route('api.patient.store'), {
                onError: () => {
                    window.history.pushState({}, null, route('newPatient'));
                    history.replaceState(null, '', route('newPatient'));
                },
                onSuccess: () => {
                    this.clearForm();
                    window.history.pushState({}, null, route('patients'));
                    history.replaceState(null, '', route('patients'));
                },
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
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
            console.log();
        },
    },
    async mounted() {
        try {
            const response = await axios.get(route('api.flags'));
            const data = response.data;
            this.degree_programs = data.degree_programs;
            this.client_types = data.client_types;
        } catch (error) {
            console.error(error);
        }
    }
};
</script>

<template>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1">
                <div class="grid grid-cols-4">
                    <InputText v-model="form.id_number" label="ID #" :errorMsg="form.errors.id_number" autofocus @input="onFocusClearError('id_number')" />
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
                    <ClearButton @click="clearForm">Clear</ClearButton>
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
                </div>
            </div>
        </form>
</template>
