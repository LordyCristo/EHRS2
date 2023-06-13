<script setup>
import InputLabel from '@/Components/Generic/Forms/InputLabel.vue';
import InputError from '@/Components/Generic/Forms/InputError.vue';

defineProps({
    name: String,
    label: String,
    errorMsg: [String, Array],
    required: Boolean,
});

</script>
<template>
    <div class="flex flex-col m-1">
        <div class="flex justify-between">
            <InputLabel :for="name" :value="label" :required="required" />
            <InputError :message="errorMsg" />
        </div>
        <slot />
    </div>
</template>
