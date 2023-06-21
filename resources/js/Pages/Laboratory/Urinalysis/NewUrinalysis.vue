<template>
    <Laboratory title="Create Form">
        <div class="flex justify-center items-center h-full w-full gap-2">
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm min-w-[40rem] max-w-[40rem]">
                <UrinalysisForm :action="action"/>
            </div>
            <div class="flex flex-col gap-2 sm:p-5 p-1 bg-gray-50 border rounded-sm h-full w-fit">
                <h2 class="font-semibold">Pending Requests: {{ $page.props.requests.data.length }}</h2>
                <p class="text-sm text-gray-600 max-w-[20rem]">
                    <b>Note:</b>This list is in ascending order of the date of request.
                </p>
                <div class="p-1 max-h-screen border overflow-y-scroll">
                    <div v-for="req in $page.props.requests.data">
                        {{ $page.props.requests.data.indexOf(req) + 1 }}.
                        {{ req.name }}
                    </div>
                </div>
            </div>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import UrinalysisForm from "@/Pages/Laboratory/Urinalysis/UrinalysisForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
