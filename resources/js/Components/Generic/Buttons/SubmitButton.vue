<script setup>
import SaveIcon from "@/Components/Icons/SaveIcon.vue";

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-vsu-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-vsu-green focus:ring-vsu-green transition ease-in-out duration-150">
        <SaveIcon class="w-4 h-auto mr-1" />
        <slot />
    </button>
</template>
