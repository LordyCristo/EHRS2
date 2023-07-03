<script setup>
import InputField from '@/Components/Generic/Forms/InputField.vue';
</script>
<script>
export default {
    props: {
        modelValue: [String, Number],
        errorMsg: [String, Array],
        id: String,
        name: String,
        label: String,
        options: [Array, Function],
        class: String,
    },
};
</script>
<style>
.selectElement {
    @apply sm:p-2 p-1 border w-full overflow-ellipsis rounded-md shadow-sm focus:border-vsu-olive focus:ring focus:ring-indigo-200 focus:ring-opacity-50 duration-300;
}
</style>
<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label">
        <select :name="name" :id="id" class="selectElement" :class="errorMsg ? 'border-red-300' : 'border-gray-300'"
            @change="$emit('update:modelValue', $event.target.value);">
            <option value="" hidden selected>Choose</option>
            <option v-for="option in options" :value="option.id" :key="option.name" :selected="modelValue === option.id">
                {{ option.name }}</option>
        </select>
    </InputField>
</template>
