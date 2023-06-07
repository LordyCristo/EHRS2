<script setup>
import { onMounted, ref } from 'vue';
import InputField from '@/Components/Generic/Forms/InputField.vue';

defineProps({
    modelValue: String,
    errorMsg: [String, Array],
    id: String,
    name: String,
    label: String,
});

</script>
<style>
.datePicker{
    @apply sm:p-2 p-1 w-full border overflow-ellipsis rounded-md shadow-sm focus:border-vsu-olive focus:ring focus:ring-indigo-200 focus:ring-opacity-50 duration-300;
}
</style>
<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label">
        <input
            :id="id"
            :name="name"
            ref="input"
            type="date"
            class="datePicker"
            :class="errorMsg?'border-red-300':''"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" />
    </InputField>
</template>
