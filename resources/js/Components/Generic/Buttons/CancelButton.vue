<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border-yellow-300 border rounded-md font-semibold text-xs hover:text-white text-vsu-green uppercase tracking-widest hover:bg-yellow-400 focus:bg-yellow-400 active:bg-yellow-600 active:text-white focus:ring-yellow-400 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
