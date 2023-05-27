<template>
    <Finance title="Create Form">
        <div class="flex justify-center items-center h-full w-full">
            <div class="max-w-5xl sm:p-5 p-1 bg-gray-100 rounded-sm w-1/2">
                <PaymentForm :action="action"/>
            </div>
        </div>
    </Finance>
</template>
<script setup>
import Finance from "@/Pages/Finance.vue";
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import PaymentForm from "@/Pages/Finance/Payment/PaymentForm.vue";
</script>
<script>
export default {
    data: () => ({
        action: 'store',
    }),
}
</script>
