<script setup>
import InputField from '@/Components/Generic/Forms/InputField.vue';

defineProps({
    value: [String, Number],
    label: String,
    required: Boolean,
    errorMsg: [String, Array],
});

</script>
<template>
    <InputField :label="label" :required="required" :errorMsg="errorMsg" autofocus>
        <div class="text-center p-2 w-full border overflow-ellipsis rounded-md">
            {{ value }}
        </div>
    </InputField>
</template>
