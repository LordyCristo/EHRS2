<script setup>
import Patients from '@/Pages/Patients.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
</script>
<script>
export default {
    props: {
        notifType: {
            type: String,
            required: false,
        },
        notifMessage: {
            type: String,
            required: false,
        },
        errors: {
            type: [String, Object],
            required: false,
        },
        degree_programs: Object,
        client_types: Object,
        last_client_id: [Number, String],
    },
    data: () => ({
        action: 'store',
    }),
}
</script>
<template>
    <Patients title="New Client">
        <h1 class="text-center">Creating new client</h1>
        <div class="flex justify-center items-center h-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-md">
                <PatientForm
                    :action="action"
                    :degree_programs="degree_programs"
                    :client_types="client_types"
                    :last_client_id="last_client_id"
                />
            </div>
        </div>
    </Patients>
</template>
