<script setup>
import Patients from '@/Pages/Patients.vue';
import PatientForm from '@/Pages/Patient/PatientForm.vue';
import BackIcon from "@/Components/Icons/BackIcon.vue";
import { Link } from "@inertiajs/vue3";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
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
        degree_programs: [Array, Object],
        client_types: [Array, Object],
        last_client_id: null,
    },
    data: () => ({
        action: 'store',
    }),
}
</script>
<template>
    <Patients title="New Client">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
               <div class="flex items-center justify-between mb-3">
                   <Link :href="route('patients')" class="text-gray-600 hover:text-gray-900 duration-300">
                          <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
                   </Link>
                   <h1 class=" text-center w-fit text-xl font-semibold">Creating new client</h1>
                   <Link :href="route('patients')" class="text-gray-600 hover:text-gray-900 duration-300">
                       <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                   </Link>
               </div>
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
