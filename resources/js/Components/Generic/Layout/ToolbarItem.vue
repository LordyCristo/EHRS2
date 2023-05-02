<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    link: {
        type: String,
        required: false,
    },
    class: {
        type: String,
        required: false,
        default: 'box-border text-gray-900 hover:text-vsu-green text-sm hover:font-extrabold box mx-2 my-1 flex items-center transition-colors duration-500',
    },
    action: {
        type: Function,
        required: false,
    },
});
</script>

<template>
    <template v-if="link">
        <Link :href="route(link)" :class="class">
            <slot name="icon" />
            <span>
                <slot />
            </span>
        </Link>
    </template>
    <template v-else>
        <button :class="class" @click="action">
            <slot name="icon" />
            <span>
                <slot />
            </span>
        </button>
    </template>
</template>
