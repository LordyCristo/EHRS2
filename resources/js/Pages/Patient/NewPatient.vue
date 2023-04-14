<script setup>
import PatientDashboard from '@/Pages/PatientsInformation.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    id_number: '19-1-00255',
    first_name: 'Cristo Rey',
    middle_name: 'Ceniza',
    last_name: 'Magdadaro',
    suffix: null,
    birthdate: '2000-11-22',
    age: '23',
    sex: 'MALE',
    blood_type: 'O-',
    civil_status: 'SINGLE',
    email: '19-1-00255@vsu.edu.ph',
    phone: '09123456789',
    home_address: 'Ormoc City, Leyte',
    curr_address: 'VSU, Baybay City, Leyte',
    degree_program_id: 1,
    year_level: '4th',
    department_id: 13,
    client_type_id: 1,
});
</script>

<template>
    <PatientDashboard title="New Client">
        <PatientForm :form="form"></PatientForm>
    </PatientDashboard>
</template>
