<script setup>
import InputField from '@/Components/Generic/Forms/InputField.vue';
</script>
<script>
export default {
    props: {
        modelValue: String,
        errorMsg: String,
        id: String,
        name: String,
        label: String,
        options: Array,
    },
    methods: {
        changeValue(value) {
            this.$emit('update:modelValue', value);
            console.log(this.modelValue);
        },
    },
};
</script>
<style>
.radioButton {
    @apply flex flex-row justify-center gap-5 items-center sm:p-2 p-1 w-full rounded-md;
}
</style>
<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label">
        <div class="radioButton" :class="errorMsg ? 'border border-red-300' : 'border-gray-300'">
            <label v-for="option in options" :key="option.id">
                <input type="radio" :id="id + '-' + option.id" :name="name" :value="option.id"
                    :checked="modelValue === option.id" @click="changeValue(option.id)" />
                {{ option.name }}
            </label>
        </div>
    </InputField>
</template>
