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
                <div>
                    <RadioButton v-model="form.client_type_id" label="Client Type" :options="client_types" required :errorMsg="form.errors.client_type_id" @input="onFocusClearError('client_type_id')" />
                </div>
                <div class="grid grid-cols-2">
                    <div class="grid grid-cols-2">
                        <InputText v-model="form.infirmary_id" :disabled="true" label="Infirmary No." required :errorMsg="form.errors.infirmary_id" @input="onFocusClearError('infirmary_id');" />
                        <InputText v-model="form.id_number" label="Student ID No." :errorMsg="form.errors.id_number" autofocus @input="onFocusClearError('id_number'); formatIdNumber($event); " />

                    </div>
                    <div class="grid grid-cols-1">
                        <InputText v-model="form.employer" label="Employer" :errorMsg="form.errors.employer" @input="onFocusClearError('employer');" />
                    </div>
                    <!--                    <Select v-model="form.client_type_id" label="Client Type" required :options="client_types" :errorMsg="form.errors.client_type_id" @input="onFocusClearError('client_type_id')" />-->
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
                    <SelectElement v-model.trim="form.religion" label="Religion" :options="Religion" :errorMsg="form.errors.religion" @input="onFocusClearError('religion')" />
                    <InputText v-model.trim="form.nationality" label="Nationality" :errorMsg="form.errors.nationality" @input="onFocusClearError('nationality')" />
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
                <div v-if="$page.props.auth.user.role === 6" class="flex items-center justify-start my-3">
                    <div class="flex items-center">
                        <input type="checkbox" v-model="form.is_emergency" @click="emergencyChange" class="rounded-full border-red-700 active:bg-red-700 checked:bg-red-700">
                        <label for="stayOnPage" class="ml-2 text-md font-medium uppercase text-red-700">Emergency</label>
                    </div>
                </div>
            </div>
            <template v-if="form.is_emergency && $page.props.auth.user.role === 6">
                <div class="grid grid-cols-1">
                    <div class="grid grid-cols-4">
                        <Datepicker v-model="form.date_admitted" label="Date" required :errorMsg="form.errors.date_admitted" @input="onFocusClearError('date_admitted')" />
                        <DateTimePicker v-model="form.time_admitted" label="Time" required :errorMsg="form.errors.time_admitted" @input="onFocusClearError('time_admitted')" />
                        <SelectElement v-model="form.brought_by" label="Brought By" required :options="BroughtBy" :errorMsg="form.errors.brought_by" @input="onFocusClearError('brought_by')" />
                        <SelectElement v-model="form.arrival_condition" label="Arrival Condition" required :options="ArrivalCondition" :errorMsg="form.errors.arrival_condition" @input="onFocusClearError('arrival_condition')" />
                    </div>
                    <div class="grid grid-cols-2">
                        <RadioButton v-model="form.temperature_location" label="Temperature Location" :options="TemperatureLocation" :errorMsg="form.errors.temperature_location" @input="onFocusClearError('temperature_location')" />
                        <div class="grid grid-cols-2">
                            <InputText v-model="form.temperature" label="Temperature" type="number" :errorMsg="form.errors.temperature" @input="onFocusClearError('temperature')" />
                            <InputText v-model="form.pulse_rate" label="Pulse Rate" type="number" :errorMsg="form.errors.pulse_rate" @input="onFocusClearError('pulse_rate')" />
                        </div>
                    </div>
                    <div class="grid grid-cols-5">
                        <InputText v-model="form.blood_pressure" label="Blood Pressure" type="text" :errorMsg="form.errors.blood_pressure" @input="onFocusClearError('blood_pressure')" />
                        <InputText v-model="form.cardiac_rate" label="Cardiac Rate" type="number" :errorMsg="form.errors.cardiac_rate" @input="onFocusClearError('cardiac_rate')" />
                        <InputText v-model="form.respiratory_rate" label="Respiratory Rate" type="number" :errorMsg="form.errors.respiratory_rate" @input="onFocusClearError('respiratory_rate')" />
                        <InputText v-model="form.oxygen_saturation" label="Oxygen Saturation" type="number" :errorMsg="form.errors.oxygen_saturation" @input="onFocusClearError('oxygen_saturation')" />
                        <InputText v-model="form.weight" label="Weight" type="number" :errorMsg="form.errors.weight" @input="onFocusClearError('weight')" />
                    </div>
                    <div class="grid grid-cols-2">
                        <InputTextArea v-model="form.chief_complaint" label="Chief Complaint" :errorMsg="form.errors.chief_complaint" @input="onFocusClearError('chief_complaint')" />
                        <InputTextArea v-model="form.allergies" label="Allergies" :errorMsg="form.errors.allergies" @input="onFocusClearError('allergies')" />
                        <InputTextArea v-model="form.physical_exam" label="Physical Exam Findings" :errorMsg="form.errors.physical_exam" @input="onFocusClearError('physical_exam')" />
                        <InputTextArea v-model="form.current_medications" label="Current Medications" :errorMsg="form.errors.current_medications" @input="onFocusClearError('current_medications')" />
                        <InputTextArea v-model="form.treatment" label="Treatment" :errorMsg="form.errors.treatment" @input="onFocusClearError('treatment')" />
                        <InputTextArea v-model="form.nurse_notes" label="Nurse Notes" :errorMsg="form.errors.nurse_notes" @input="onFocusClearError('nurse_notes')" />
                    </div>
                    <div class="grid grid-cols-1">
                        <InputTextArea v-model="form.diagnosis" label="Diagnosis" rrorMsg="form.errors.diagnosis" @input="onFocusClearError('diagnosis')" />
                    </div>
                    <div class="grid grid-cols-3">
                        <Datepicker v-model="form.date_disposition" label="Date of Disposition" :errorMsg="form.errors.date_disposition" @input="onFocusClearError('date_disposition')" />
                        <DateTimePicker v-model="form.time_disposition" label="Time of Disposition" :errorMsg="form.errors.time_disposition" @input="onFocusClearError('time_disposition')" />
                        <RadioButton v-model="form.discharge_condition" label="Condition on Discharge" :options="DepartCondition" :errorMsg="form.errors.discharge_condition" @input="onFocusClearError('discharge_condition')" />
                        <SelectElement v-model="form.disposition" label="Disposition" :options="Disposition" :errorMsg="form.errors.disposition" @input="onFocusClearError('disposition')" />
                        <InputText v-model="form.attending_nurse" label="Attending Nurse" :errorMsg="form.errors.attending_nurse" @input="onFocusClearError('attending_nurse')" />
                        <InputText v-model="form.attending_physician" label="Attending Physician" :errorMsg="form.errors.attending_physician" @input="onFocusClearError('attending_physician')" />
                    </div>
                </div>
            </template>
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import DateTimePicker from "@/Components/Generic/Forms/DateTimePicker.vue";
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import {
    ArrivalCondition,
    BroughtBy,
    DepartCondition,
    Disposition,
    Religion,
    TemperatureLocation
} from "@/Legends/legends";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
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
                infirmary_id: null,
                first_name: null,
                middle_name: null,
                last_name: null,
                suffix: null,
                birthdate: null,
                age: null,
                sex: null,
                religion: null,
                nationality: null,
                civil_status: null,
                phone: null,
                email_address: null,
                home_address: null,
                curr_address: null,
                employer: null,
                id_number: null,
                program_id: null,
                year_lvl: null,
                client_type_id: null,
                is_emergency: false,
                //emergency details
                date_admitted: null,
                time_admitted: null,
                brought_by: null,
                arrival_condition: null,
                temperature: null,
                temperature_location: null,
                weight: null,
                pulse_rate: null,
                blood_pressure: null,
                cardiac_rate: null,
                respiratory_rate: null,
                oxygen_saturation: null,
                chief_complaint: null,
                allergies: null,
                physical_exam: null,
                current_medications: null,
                treatment: null,
                nurse_notes: null,
                diagnosis: null,
                date_disposition: null,
                time_disposition: null,
                disposition: null,
                discharge_condition: null,
                attending_nurse: null,
                attending_physician: null,
            }),
        };
    },
    methods: {
        emergencyChange() {
            this.$emit('emergencyChange', this.form.is_emergency);
        },
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
    watch: {
        'form.program_id': function (val) {
            if (!val) {
                this.form.year_lvl = null;
            }
        },
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Client Details';
            this.data = this.$page.props.data.data;
            console.log(this.data);
        }else{
            this.formTitle = 'Register New Client';
            this.form.infirmary_id = this.$page.props.last_client_id.infirmary_id? this.$page.props.last_client_id.infirmary_id + 1: 1;
            this.form.nationality = 'Filipino';
        }

        this.degree_programs = this.$page.props.degree_programs;
        this.client_types = this.$page.props.client_types;
    }
};
</script>
