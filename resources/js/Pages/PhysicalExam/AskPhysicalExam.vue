<template>
    <PhysicalExam title="Create Form">
        <div class="flex justify-center h-full w-full">
            <div class="flex flex-col text-center max-w-5xl sm:p-5 p-1">
                <h1 class="mb-5 font-semibold text-xl">Choose form type</h1>
                <div class="flex gap-2">
                    <Link v-for="item in clientTypes" :href="route(item.link)" :key="item.id" class="bg-vsu-green shadow-lg hover:bg-vsu-olive text-white font-bold py-2 px-4 rounded-md">
                        {{ item.name }}
                    </Link>
                </div>
            </div>
        </div>
    </PhysicalExam>
</template>
<script setup>
import PhysicalExam from "@/Pages/PhysicalExam.vue";
import { Link } from '@inertiajs/vue3';
</script>
<script>
export default {
    data: () => ({
        action: 'store',
        clientTypes: [
            { id:'student', name:'Student', link: 'student.physicalexam.create' },
            { id:'outpatient', name:'Outpatient', link: 'outpatient.physicalexam.create' },
            { id:'er', name:'Emergency Room ', link: 'er.physicalexam.create'}
        ],
    }),
}
</script>
