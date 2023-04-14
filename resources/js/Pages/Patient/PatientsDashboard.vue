<script setup>
import PatientDashboard from '@/Pages/PatientsInformation.vue';
import DataTable from '@/Components/Generic/Layout/DataTable.vue';

const columns = [
  { data: 'id', title: 'ID' },
  { data: 'first_name', title: 'First Name' },
  { data: 'middle_name', title: 'Middle' },
  { data: 'last_name', title: 'Surname' },
  { data: 'suffix', title: 'Suffix' },
  { data: 'age', title: 'Age' },
  { data: 'sex', title: 'Sex' },
  { data: 'blood_type', title: 'Blood' },
  { data: 'civil_status', title: 'Civil Status' },
  { data: 'degree_program_id', title: 'Program' },
  { data: 'year_level', title: 'Year' },
];
</script>

<template>
    <PatientDashboard title="New Patient">
        <DataTable :columns="columns"></DataTable>
    </PatientDashboard>
</template>
