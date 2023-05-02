<script setup>
defineProps({
    message: String,
});
</script>
<style>
.inputError{
    @apply text-xs text-red-600 w-fit text-right whitespace-nowrap overflow-hidden overflow-ellipsis;
}
</style>
<template>
    <p class="inputError" v-show="message">
        {{ message }}
    </p>
</template>
