<script setup>
defineProps({
    value: String,
    required: Boolean,
});
</script>
<style>
.inputLabel{
    @apply text-sm whitespace-nowrap text-gray-600 font-normal;
}
</style>
<template>
    <label class="inputLabel"  v-show="value" :title="required?'Required field':''">
        <template v-if="value">
            {{ value }}
        </template>
        <template v-else>
            <slot />
        </template>
        <span v-if="required" class="text-red-500 "> *</span>
    </label>
</template>
