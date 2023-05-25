<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LandingNavBar from "@/Components/LandingNavBar.vue";
import LandingFooter from '@/Components/LandingFooter.vue';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen">
        <landing-nav-bar></landing-nav-bar>
        <div class="p-6 flex flex-col flex-auto">
            <h1 class="text-lg text-center font-roboto">Visayas State University Hospital EHR System is currently under development, please standby until further notice</h1>
        </div>
    </div>
    <landing-footer></landing-footer>
</template>
