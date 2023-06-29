<template>
    <AppLayout>
        <div class="flex flex-col justify-center items-center min-h-screen w-full gap-3">
            <h1 class="text-red-600 uppercase font-semibold text-2xl">Unauthorized Access</h1>
            <button @click="$router.go(-1)" class="flex gap-1 bg-vsu-green text-white px-3 py-1 rounded-md hover:scale-110"><BackIcon class="text-white w-6 text-sm"/>Back</button>

        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BackIcon from "@/Components/Icons/BackIcon.vue";
</script>
