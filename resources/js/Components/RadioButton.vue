<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Boolean],
        default: false,
    },
    name:{
        type: String,
        default: null,
    },
    value: {
        type: String,
        default: null,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    checked: {
        type: Boolean,
        default: false,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div>
        <input
        v-model="proxyChecked"
        type="radio"
        :value="value"
        :name="name"
        :disabled="disabled"
        :checked="checked"
        class="rounded-full border-vsu-olive text-vsu-gren shadow-sm focus:ring-0 checked:bg-vsu-green focus:bg-vsu-green active:bg-vsu-green"
        >
        <span class="ml-1"><slot /></span>
    </div>
</template>
