<script setup>
import InputLabel from '@/Components/Generic/Forms/InputLabel.vue';
import InputError from '@/Components/Generic/Forms/InputError.vue';

defineProps({
    name: String,
    label: String,
    errorMsg: String,
}); 

</script>
<style>
.inputField{
    @apply flex flex-row items-center justify-between gap-2;
}
</style>
<template>
    <div class="p-1">
        <div class="inputField">
            <InputLabel :for="name" :value="label" />
            <InputError :message="errorMsg" />
        </div>
        <slot />
    </div>
</template>