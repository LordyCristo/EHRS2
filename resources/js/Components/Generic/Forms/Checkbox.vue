<script setup>
import {onMounted, ref, watch} from 'vue';

const props = defineProps({
    modelValue: [Boolean, Number],
    label: String,
    required: Boolean,
});

const input = ref(null);

watch(() => props.modelValue, (value) => {
    input.value.checked = value;
});

defineExpose({ focus: () => input.value.focus() });

</script>
<template>
    <div class="w-fit flex flex-row items-center gap-1">
        <input
            ref="input"
            type="checkbox"
            class="border-gray-900"
            :checked="props.modelValue"
            @input="$emit('update:modelValue', props.modelValue = !props.modelValue)"
        />
        <label>{{ props.label }}</label>
    </div>
</template>
