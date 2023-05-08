<script setup>
import PatientDashboard from '@/Pages/Patients.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
</script>

<template>
    <PatientDashboard title="New Client">
        <h1 class="text-center">Creating new client</h1>
        <div class="flex justify-center items-center h-full">    
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-md">
                <PatientForm></PatientForm>
            </div>
        </div>
    </PatientDashboard>
</template>
