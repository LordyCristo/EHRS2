<template>
    <Clients title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
                <div class="flex items-center justify-between mb-3 gap-2">
                    <Link :href="route('client.index')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
                    </Link>
                    <h1 class=" text-center w-fit text-xl font-semibold">Register New Client</h1>
                    <Link :href="route('client.index')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                    </Link>
                </div>
                <ClientForm :action="action" :data="data" :degree_programs="degree_programs" :client_types="client_types" :last_client_id="last_client_id" />
            </div>
        </div>
    </Clients>
</template>
<script setup>
import Clients from '@/Pages/Clients.vue';
import { Link } from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import ClientForm from "@/Pages/Client/ClientForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'update',
    }),
    props: {
        data: Object,
        degree_programs: Object,
        client_types: Object,
        last_client_id: Number,
    },
}
</script>
