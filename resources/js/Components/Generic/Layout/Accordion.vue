<template>
    <div v-for="(item, index) in items" :key="index">
        <div @click="toggleAccordion(index)"
             :class="{'bg-gray-200': item.isOpen,'bg-white': !item.isOpen,'rounded-t-lg': index === 0,'rounded-b-lg': index === items.length - 1}"
             class="cursor-pointer px-4 py-2">
            <div class="flex items-center justify-between">
                <div class="text-sm font-medium whitespace-nowrap">{{ item.title }}</div>
                <div :class="{'transform rotate-180': item.isOpen}" class="transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
        <transition name="fade">
            <div v-if="item.isOpen" class="bg-white px-4 py-2">
                <div class="text-gray-600">{{ item.content }}s</div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [
                { title: 'Accordion Item 1', content: 'Content 1', isOpen: false },
            ],
        };
    },
    methods: {
        toggleAccordion(index) {
            this.items[index].isOpen = !this.items[index].isOpen;
        },
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
