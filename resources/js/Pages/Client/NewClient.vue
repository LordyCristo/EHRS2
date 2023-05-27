<template>
    <Clients title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
                <ClientForm :action="action" />
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
        action: 'store',
    }),
}
</script>
