<script setup>
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";

defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border-red-300 border rounded-md font-semibold text-xs hover:text-white text-red-700 uppercase tracking-widest hover:bg-red-400 focus:bg-red-400 active:bg-red-600 active:text-white focus:ring-red-400 transition ease-in-out duration-150">
        <DeleteIcon class="w-4 h-auto" />
        <slot />
    </button>
</template>
