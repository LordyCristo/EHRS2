<script setup>
import PatientDashboard from '@/Pages/PatientsInformation.vue';
import DataTable from '@/Components/Generic/Layout/DataTable.vue';
import EditButton from '@/Components/Generic/Buttons/EditButton.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import { markRaw } from 'vue';
import { Link } from '@inertiajs/vue3';
const columns = [
    { data: 'id', title: 'ID' },
    { data: 'first_name', title: 'First Name' },
    { data: 'middle_name', title: 'Middle' },
    { data: 'last_name', title: 'Surname' },
    { data: 'suffix', title: 'Suffix' },
    { data: 'age', title: 'Age' },
    { data: 'sex', title: 'Sex' },
    { data: 'civil_status', title: 'Civil Status' },
    { data: 'client_type_id', title: 'Type' },
    {
        data: null,
        title: 'Action',
        render: function (data, type, row) {
            return `<a href="/api/patient/${data.id}"><button class="inline-flex items-center px-2 py-1 text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-700 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-yellow-400"><svg class="w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Edit</button></a>`;
        },
    },
];
</script>

<template>
    <PatientDashboard title="New Patient">
        <DataTable :columns="columns"></DataTable>
    </PatientDashboard>
</template>
