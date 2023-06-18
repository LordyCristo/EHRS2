<script>
export default {
    data: () => ({
        input: null,
    }),
    props: {
        modelValue: {
            type: [Boolean, Number],
            default: false
        },
        label: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        }
    },
};
</script>
<template>
    <div class="w-fit flex flex-row items-center gap-1">
        <input
            ref="input"
            type="checkbox"
            class="border-gray-900"
            :checked="modelValue"
            @input="$emit('update:modelValue', modelValue = !modelValue)"
        />
        <label>{{ label }}</label>
    </div>
</template>
