<script setup>
import { ref, onMounted, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import InputText from '@/Components/Generic/Forms/InputText.vue';
import SelectElement from '@/Components/Generic/Forms/SelectElement.vue';
import Datepicker from '@/Components/Generic/Forms/Datepicker.vue';
import RadioButton from '@/Components/Generic/Forms/RadioButton.vue';

defineProps({
    form: {
        type: Object,
        required: false,
        default: useForm({
            id_number: null,
            first_name: null,
            middle_name: null,
            last_name: null,
            suffix: null,
            birthdate: null,
            age: null,
            sex: null,
            blood_type: null,
            civil_status: null,
            email: null,
            phone: null,
            home_address: null,
            curr_address: null,
            degree_program_id: null,
            year_level: null,
            department_id: null,
            client_type_id: null,
        }),
    },
});



const sexes = [
    { value: 'MALE', label: 'Male' },
    { value: 'FEMALE', label: 'Female' },
];

const blood_types = [
    { id: 'O+', name: 'O+' },
    { id: 'O-', name: 'O-' },
    { id: 'A+', name: 'A+' },
    { id: 'A-', name: 'A-' },
    { id: 'B+', name: 'B+' },
    { id: 'B-', name: 'B-' },
    { id: 'AB+', name: 'AB+' },
    { id: 'AB-', name: 'AB-' },
];

const civil_statuses = [
    { id: 'SINGLE', name: 'Single' },
    { id: 'MARRIED', name: 'Married' },
    { id: 'WIDOWED', name: 'Widowed' },
    { id: 'SEPARATED', name: 'Separated' },
    { id: 'DIVORCED', name: 'Divorced' },
];

const year_levels = [
    { id: '1st', name: '1st' },
    { id: '2nd', name: '2nd' },
    { id: '3rd', name: '3rd' },
    { id: '4th', name: '4th' },
    { id: '5th', name: '5th' },
    { id: '6th', name: '6th' },
];

const degree_programs = ref(Array);
const departments = ref(Array);
const client_types = ref(Array);

onMounted(async () => {
    try {
        const response = await axios.get(route('api.universityDB'));
        const data = response.data;
        degree_programs.value = data.degree_programs;
        departments.value = data.departments;
        client_types.value = data.client_types;
    } catch (error) {
        console.error(error);
    }
});

const submit = () => {
    try {
        axios.post(route('api.patient.store'), form).then(response => {
            const data = JSON.stringify(response.data);
            form.cancel();
        })
    } catch (error) {
        console.error(error);
    }
};
</script>
<style>
.submitButton {
    @apply ml-4 bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-vsu-green focus:ring-vsu-green;
}

.cancelButton {
    @apply hover:text-white border-red-300 hover:bg-red-400 focus:bg-red-400 active:bg-red-600 active:text-white focus:ring-red-400;
}
</style>
<template>
    <template v-if="form.id_number">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 max-w-4xl mx-auto sm:p-10 p-1 bg-gray-50 shadow-inner">
                <div class="grid grid-cols-4">
                    <InputText v-model="form.id_number" id="id_number" name="id_number" label="IDs number"
                        :errorMsg="form.errors.id_number" autofocus></InputText>
                    <InputText v-model="form.infirmary_number" id="infirmary_number" name="infirmary_number"
                        label="Infirmary number" :errorMsg="form.errors.infirmary_number"></InputText>
                    <SelectElement v-model="form.client_type_id" id="client_type_id" name="client_type_id"
                        label="Client Type" :options="client_types" :errorMsg="form.errors.client_type_id">
                    </SelectElement>
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
                    <SelectElement v-model="form.blood_type" id="blood_type" name="blood_type" label="Blood Type"
                        :options="blood_types" :errorMsg="form.errors.blood_type"></SelectElement>
                </div>
                <div class="grid grid-cols-4">
                    <SelectElement v-model="form.civil_status" id="civil_status" name="civil_status" label="Civil Status"
                        :options="civil_statuses" :errorMsg="form.errors.civil_status"></SelectElement>
                    <InputText v-model="form.email" id="email" name="email" label="Email" type="email"
                        :errorMsg="form.errors.email"></InputText>
                    <InputText v-model="form.phone" id="phone" name="phone" label="Phone" type="tel"
                        :errorMsg="form.errors.phone"></InputText>
                </div>
                <div class="grid grid-rows-2">
                    <InputText v-model="form.home_address" id="home_address" name="home_address" label="Home Address"
                        class="w-full" type="text" :errorMsg="form.errors.home_address"></InputText>
                    <InputText v-model="form.curr_address" id="curr_address" name="curr_address" label="Current Address"
                        class="w-full" type="text" :errorMsg="form.errors.curr_address"></InputText>
                </div>
                <div class="grid grid-cols-3">
                    <SelectElement v-model="form.department_id" id="department_id" name="department_id" label="Department"
                        :options="departments" :errorMsg="form.errors.department_id"></SelectElement>
                    <SelectElement v-model="form.degree_program_id" id="degree_program_id" name="degree_program_id"
                        label="Degree Program" :options="degree_programs" :errorMsg="form.errors.degree_program_id">
                    </SelectElement>
                    <SelectElement v-model="form.year_level" id="year_level" name="year_level" label="Year Level"
                        :options="year_levels" :errorMsg="form.errors.year_level"></SelectElement>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton type="reset" class="cancelButton">Clear</SecondaryButton>
                    <PrimaryButton type="submit" class="submitButton" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">Save</PrimaryButton>
                </div>
            </div>
        </form>
    </template>
    <template v-else>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 max-w-4xl mx-auto p-10 bg-gray-50 shadow-inner">
                <div class="grid grid-cols-4">
                    <InputText v-model="form.id_number" id="id_number" name="id_number" label="ID number"
                        :errorMsg="form.errors.id_number" autofocus></InputText>
                    <InputText v-model="form.infirmary_number" id="infirmary_number" name="infirmary_number"
                        label="Infirmary number" :errorMsg="form.errors.infirmary_number"></InputText>
                    <SelectElement v-model="form.client_type_id" id="client_type_id" name="client_type_id"
                        label="Client Type" :options="client_types" :errorMsg="form.errors.client_type_id">
                    </SelectElement>
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
                    <SelectElement v-model="form.blood_type" id="blood_type" name="blood_type" label="Blood Type"
                        :options="blood_types" :errorMsg="form.errors.blood_type"></SelectElement>
                </div>
                <div class="grid grid-cols-4">
                    <SelectElement v-model="form.civil_status" id="civil_status" name="civil_status" label="Civil Status"
                        :options="civil_statuses" :errorMsg="form.errors.civil_status"></SelectElement>
                    <InputText v-model="form.email" id="email" name="email" label="Email" type="email"
                        :errorMsg="form.errors.email"></InputText>
                    <InputText v-model="form.phone" id="phone" name="phone" label="Phone" type="tel"
                        :errorMsg="form.errors.phone"></InputText>
                </div>
                <div class="grid grid-rows-2">
                    <InputText v-model="form.home_address" id="home_address" name="home_address" label="Home Address"
                        class="w-full" type="text" :errorMsg="form.errors.home_address"></InputText>
                    <InputText v-model="form.curr_address" id="curr_address" name="curr_address" label="Current Address"
                        class="w-full" type="text" :errorMsg="form.errors.curr_address"></InputText>
                </div>
                <div class="grid grid-cols-3">
                    <SelectElement v-model="form.department_id" id="department_id" name="department_id" label="Department"
                        :options="departments" :errorMsg="form.errors.department_id"></SelectElement>
                    <SelectElement v-model="form.degree_program_id" id="degree_program_id" name="degree_program_id"
                        label="Degree Program" :options="degree_programs" :errorMsg="form.errors.degree_program_id">
                    </SelectElement>
                    <SelectElement v-model="form.year_level" id="year_level" name="year_level" label="Year Level"
                        :options="year_levels" :errorMsg="form.errors.year_level"></SelectElement>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton type="reset" class="cancelButton">Clear</SecondaryButton>
                    <PrimaryButton type="submit" class="submitButton" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">Save</PrimaryButton>
                </div>
            </div>
        </form>

    </template>
</template>
