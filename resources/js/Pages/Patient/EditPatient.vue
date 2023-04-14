<script setup>
import PatientDashboard from '@/Pages/PatientsInformation.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
import { ref, onMounted, defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';


const form = useForm([]);

onMounted(async () => {
    try {
        const response = await axios.get(route('api.patient.show', '1'));
        const data = response.data;
        form.value = useForm(data);
    } catch (error) {
        console.log(error);
    }
});

</script>
<template>
    <PatientDashboard title="Edit Patient">
        <PatientForm :form="form.value"></PatientForm>
    </PatientDashboard>
</template>
