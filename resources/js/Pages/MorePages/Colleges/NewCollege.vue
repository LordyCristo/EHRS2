<template>
    <MorePages title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm">
                <div class="flex items-center justify-between mb-3 gap-2">
                    <Link :href="route('more.colleges')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
                    </Link>
                    <h1 class=" text-center w-fit text-xl font-semibold">Register New College</h1>
                    <Link :href="route('more.colleges')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                    </Link>
                </div>
                <CollegeForm :action="action" />
            </div>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import CollegeForm from "@/Pages/MorePages/Colleges/CollegeForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'create',
    }),
}
</script>
