<script setup>
import { computed, onMounted } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
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
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});

onMounted(async () => {
    //console.log('Checkbox Component with a name "'+props.name+'" is mounted successfully');
});
</script>

<template>
    <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    :name="name"
    :disabled="disabled"
    class="rounded-full border-gray-300 focus:ring-1 checked:bg-vsu-green checked:hover:bg-vsu-olive checked:active:bg-vsu-green active:bg-white  hover:bg-white">
    <span><slot /></span>
</template>
