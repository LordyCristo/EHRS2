<template>
    <MorePages title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <HematologyForm :action="action" />
            </div>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import HematologyForm from "@/Pages/Laboratory/Hematology/HematologyForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'update',
    }),
}
</script>
