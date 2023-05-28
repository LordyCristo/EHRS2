<script setup>
import WarningIcon from '@/Components/Icons/WarningIcon.vue';
import CloseIcon from '@/Components/Icons/CloseIcon.vue';
</script>
<script>
export default {
    props: {
        message: String,
        type: String,
        status: Boolean,
    },
    methods: {
        closeBanner(){
            this.$emit('updateNotification');
        }
    }
}
</script>
<template>
    <transition enter-active-class="duration-300"
                enter-from-class="translate-x-full"
                enter-to-class="translate-x-0"
                leave-active-class="duration-300"
                leave-from-class="translate-x-0"
                leave-to-class="translate-x-full">
        <div v-if="status" class="z-50 fixed bottom-3 right-3 flex items-center duration-1000 overflow-hidden bg-green-200 px-5 py-1 sm:px-3.5 sm:before:flex-1">
            <warning-icon v-if="type === 'success'" class="w-6 mr-1 text-green-800"/>
            <warning-icon v-if="type === 'warning'" class="w-6 mr-1 text-yellow-400"/>
            <div class="w-full">
                {{ message }}
            </div>
            <button type="button" @click="closeBanner" class="ml-1">
                <span class="sr-only">Dismiss</span>
                <close-icon class="w-6 h-auto text-gray-400 hover:text-gray-700 hover:rotate-90 duration-300"/>
            </button>
        </div>
    </transition>
</template>
