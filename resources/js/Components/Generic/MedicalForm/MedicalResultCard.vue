<template>
    <div class="flex flex-col gap-1 rounded-md my-1">
        <div class="flex justify-between text-white bg-vsu-green px-2 py-1">
            <slot name="details" />
            <button @click="is_open = !is_open" class="bg-vsu-olive px-2 rounded-sm hover:bg-vsu-yellow-green">{{ is_open? 'Collapse':'Open' }}</button>
        </div>
        <div v-show="is_open" class="grid grid-cols-3 px-2 pb-2 border border-gray-300">
            <slot name="content"/>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const is_open = ref(false);
</script>
