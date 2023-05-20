<script setup>
import ClearIcon from "@/Components/Icons/ClearIcon.vue";

defineProps({
    type: {
        type: String,
        default: 'reset',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border-red-300 border rounded-md font-semibold text-xs hover:text-white text-vsu-green uppercase tracking-widest hover:bg-red-400 focus:bg-red-400 active:bg-red-600 active:text-white focus:ring-red-400 transition ease-in-out duration-150">
        <ClearIcon class="w-4 h-auto" />
        <slot />
    </button>
</template>
