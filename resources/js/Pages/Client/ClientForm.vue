<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="client.index"
                 :update-link="data? route('api.client.update', data.id): null"
                 :store-link="route('api.client.store')"
                 :delete-link="data? route('api.client.destroy', data.id): null"
    >
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
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
            </div>
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
import axios from "axios";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            sexes: Sex,
            civil_statuses: CivilStatus,
            year_levels: YearLevel,
            data: null,
            degree_programs: null,
            client_types: null,
            last_client_id: null,
            formTitle: null,
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
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Client Details';
            this.data = this.$page.props.data.data;
        }else{
            this.formTitle = 'Register New Client';
        }
        this.last_client_id = this.$page.props.last_client_id;
        this.degree_programs = this.$page.props.degree_programs;
        this.client_types = this.$page.props.client_types;
    }
};
</script>
