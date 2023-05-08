<script setup>
defineProps({
    value: String,
});
</script>
<style>
.inputLabel{
    @apply text-sm whitespace-nowrap text-gray-600 font-normal;
}
</style>
<template>
    <label class="inputLabel"  v-show="value">
        <template v-if="value">
            {{ value }}
        </template>
        <template v-else>
            <slot />
        </template>
    </label>
</template>
