
<script setup>
import { computed, onMounted, onUnmounted, ref, defineProps } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    name: {
        type: String,
        default: null
    },
    data: {
        type: [Array, Function],
        default: null
    }
});

let open = ref(false);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
    return {
        '48': 'w-48',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    }

    if (props.align === 'right') {
        return 'origin-top-right right-0';
    }

    return 'origin-top';
});
</script>

<template>
    <select :name="name" class="text-gray-900 border-gray-300 focus:border-vsu-green focus:ring-vsu-green focus:shadow-lg rounded-md shadow-sm"
        @change="$emit('modelValue', $event.target.value)"
    >
        <option value="" hidden select>Choose</option>
        <option v-for="d in data" :value="d.id" :key="d.id">{{ d.name }}</option>
    </select>
</template>
