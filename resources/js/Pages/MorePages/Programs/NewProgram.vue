<template>
    <MorePages title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm w-1/2">
                <div class="flex items-center justify-between mb-3 gap-2">
                    <Link :href="route('more.program.index')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
                    </Link>
                    <h1 class=" text-center w-fit text-xl font-semibold">Register New Degree Program</h1>
                    <Link :href="route('more.program.index')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                    </Link>
                </div>
                <ProgramForm :action="action"/>
            </div>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import ProgramForm from "@/Pages/MorePages/Programs/ProgramForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
