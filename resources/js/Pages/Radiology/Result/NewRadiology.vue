<template>
    <Radiology title="Create Form">
        <div class="flex flex-row justify-evenly items-center h-full w-full">
            <div class="flex flex-col gap-2 sm:p-5 p-1 bg-gray-50 border rounded-sm h-full w-fit">
                <h2 class="font-semibold">Pending Requests: {{ xray_reqs.data.length }}</h2>
                <p class="text-sm text-gray-600 max-w-[20rem]">
                    <b>Note:</b>This list is in ascending order of the date of request. Request number is enclosed in parentheses.
                </p>
                <div class="p-1 max-h-screen border overflow-y-scroll">
                    <div v-for="req in xray_reqs.data">
                        {{ xray_reqs.data.indexOf(req) + 1 }}.
                        ({{ req.id }})
                        {{ req.name }}
                    </div>
                </div>
            </div>
            <div class="sm:p-5 p-1 bg-gray-100 rounded-sm">
                <RadiologyForm :action="action"/>
            </div>
        </div>
    </Radiology>
</template>
<script setup>
import Radiology from "@/Pages/Radiology.vue";
import RadiologyForm from "@/Pages/Radiology/Result/RadiologyForm.vue";
</script>
<script>
export default {
    props: {
        xray_reqs: Object
    },
    data: () => ({
        action: 'store',
    }),
}
</script>
