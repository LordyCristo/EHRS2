<script setup>
import WarningIcon from '@/Components/Icons/WarningIcon.vue';
import CloseIcon from '@/Components/Icons/CloseIcon.vue';
</script>
<script>
export default {
    props: {
        message: {
            type: String,
            required: false,
        },
        type: {
            type: String,
            required: false,
        },
    },
    data() {
        return {
            show: true,
        }
    },
    methods: {
        closeNotifBanner() {
            this.show = false;
        }
    }
}
</script>
<template>
    <div v-if="type && message" :class="{ 'hidden': !show }"
        class="fixed bottom-3 right-3 flex items-center overflow-hidden bg-gray-100 px-5 py-1 sm:px-3.5 sm:before:flex-1">
        <warning-icon v-if="type === 'success'" class="w-6 mr-1 text-gray-400"/>
        <warning-icon v-if="type === 'warning'" class="w-6 mr-1 text-yellow-400"/>
        <div class="w-full">
            {{ message }}
        </div>
        <button type="button" @click="closeNotifBanner()" class="ml-1">
            <span class="sr-only">Dismiss</span>
            <close-icon class="w-6 h-auto text-gray-400 hover:text-gray-700"/>
        </button>
    </div>
</template>
