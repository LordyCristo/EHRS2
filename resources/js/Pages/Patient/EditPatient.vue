<script setup>
import Patient from '@/Pages/Patients.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
</script>
<script>
export default {
    props: {
        data: Object,
        degree_programs: Object,
        client_types: Object,
    },
    data: () => ({
        action: 'update',
    }),
}
</script>
<template>
    <Patient title="Edit Patient">
        <h1 class="text-center">Updating Client Details</h1>
        <div class="flex justify-center items-center h-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-md">
                <PatientForm
                    :action="action"
                    :data="data"
                    :degree_programs="degree_programs"
                    :client_types="client_types"
                />
            </div>
        </div>
    </Patient>
</template>
