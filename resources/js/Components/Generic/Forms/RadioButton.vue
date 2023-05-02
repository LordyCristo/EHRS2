<script setup>
import { onMounted, ref } from 'vue';
import InputField from '@/Components/Generic/Forms/InputField.vue';

defineProps({
    modelValue: String,
    errorMsg: String,
    id: String,
    name: String,
    label: String,
    options: Array,
});
</script>
<style>
.radioButton{
    @apply flex flex-row justify-center gap-5 items-center sm:p-2 p-1 w-full rounded-md;
}
</style>
<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label">
        <div class="radioButton"
            :class="errorMsg?'border border-red-300':'border-gray-300'">
                <label v-for="option in options" :key="option.value">
                    <input type="radio" :id="id + '-' + option.value" :name="name" :value="option.value" :checked="modelValue === option.value"  @change="$emit('update:modelValue', $event.target.value)"/>
                    {{ option.label }}
                </label>
        </div>
    </InputField>
</template>
