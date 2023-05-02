<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import InputText from '@/Components/Generic/Forms/InputText.vue';
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import Datepicker from '@/Components/Generic/Forms/Datepicker.vue';
import RadioButton from '@/Components/Generic/Forms/RadioButton.vue';
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
</script>

<script>
export default {
    data() {
        return {
            degree_programs: ref(Array),
            //departments: ref(Array),
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
                onSuccess: () => {
                    this.clearForm();
                },
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        }
    },
    async mounted() {
        try {
            const response = await axios.get(route('api.flags'));
            const data = response.data;
            this.degree_programs = data.degree_programs;
            console.log(this.degree_programs);
            //this.departments = data.departments;
            this.client_types = data.client_types;
        } catch (error) {
            console.error(error);
        }
    }
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 max-w-4xl mx-auto sm:p-10 p-1 bg-gray-50 shadow-inner">
            <div class="grid grid-cols-4">
                <InputText v-model="form.id_number" id="id_number" name="id_number" label="ID number"
                    :errorMsg="form.errors.id_number" autofocus></InputText>
                <Select v-model="form.client_type_id" id="client_type_id" name="client_type_id"
                    label="Client Type" :options="client_types" :errorMsg="form.errors.client_type_id">
                </Select>
            </div>
            <div class="grid grid-cols-4">
                <InputText v-model="form.first_name" id="first_name" name="first_name" label="First Name"
                    :errorMsg="form.errors.first_name"></InputText>
                <InputText v-model="form.middle_name" id="middle_name" name="middle_name" label="Middle Name"
                    :errorMsg="form.errors.middle_name"></InputText>
                <InputText v-model="form.last_name" id="last_name" name="last_name" label="Last Name"
                    :errorMsg="form.errors.last_name"></InputText>
                <InputText v-model="form.suffix" id="suffix" name="suffix" label="Suffix"
                    :errorMsg="form.errors.suffix">
                </InputText>
            </div>
            <div class="grid grid-cols-4">
                <Datepicker v-model="form.birthdate" id="birthdate" name="birthdate" label="Birthdate"
                    :errorMsg="form.errors.birthdate"></Datepicker>
                <InputText v-model="form.age" id="age" name="age" label="Age" type="number" :errorMsg="form.errors.age">
                </InputText>
                <RadioButton v-model="form.sex" id="sex" name="sex" label="Sex" :options="sexes"
                    :errorMsg="form.errors.sex"></RadioButton>
                <Select v-model="form.civil_status" id="civil_status" name="civil_status" label="Civil Status"
                    :options="civil_statuses" :errorMsg="form.errors.civil_status"></Select>
            </div>
            <div class="grid grid-cols-2">
                <InputText v-model="form.email_address" id="email_address" name="email_address" label="Email"
                    type="email" :errorMsg="form.errors.email_address"></InputText>
                <InputText v-model="form.phone" id="phone" name="phone" label="Phone" type="tel"
                    :errorMsg="form.errors.phone"></InputText>
            </div>
            <div class="grid grid-cols-2">
                <InputText v-model="form.home_address" id="home_address" name="home_address" label="Home Address"
                    class="w-full" type="text" :errorMsg="form.errors.home_address"></InputText>
                <InputText v-model="form.curr_address" id="curr_address" name="curr_address" label="Current Address"
                    class="w-full" type="text" :errorMsg="form.errors.curr_address"></InputText>
            </div>
            <div class="grid grid-cols-2">
                <!-- <SelectElement v-model="form.department_id" id="department_id" name="department_id" label="Department"
                    :options="departments" :errorMsg="form.errors.department_id"></SelectElement> -->
                <Select v-model="form.program_id" id="program_id" name="program_id" label="Degree Program"
                    :options="degree_programs" :errorMsg="form.errors.program_id">
                </Select>
                <Select v-model="form.year_lvl" id="year_lvl" name="year_lvl" label="Year Level"
                    :options="year_levels" :errorMsg="form.errors.year_lvl"></Select>
            </div>
            <div class="flex items-center justify-between mt-4">
                <SecondaryButton type="reset" class="cancelButton" @click="clearForm">Clear</SecondaryButton>
                <PrimaryButton type="submit" class="submitButton" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">Save</PrimaryButton>
            </div>
        </div>
    </form>
</template>
<style>
.submitButton {
    @apply ml-4 bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-vsu-green focus:ring-vsu-green;
}

.cancelButton {
    @apply hover:text-white border-red-300 hover:bg-red-400 focus:bg-red-400 active:bg-red-600 active:text-white focus:ring-red-400;
}
</style>