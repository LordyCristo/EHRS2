<template>
    <div class="flex items-center justify-between mb-3 gap-2">
        <button @click="$router.go(-1)" class="text-gray-600 hover:text-gray-900 duration-300">
            <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
        </button>
        <h1 class=" text-center w-fit text-xl font-semibold"><slot /></h1>
        <button @click="$router.go(-1)" class="text-gray-600 hover:text-gray-900 duration-300">
            <CloseIcon class="w-7 h-auto hover:rotate-90 duration-300" />
        </button>
    </div>
</template>
<script setup>
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import BackIcon from "@/Components/Icons/BackIcon.vue";

defineProps({
    link: {
        type: String,
        required: false,
    },
})
</script>
