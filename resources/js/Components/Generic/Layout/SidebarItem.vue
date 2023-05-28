<script setup>
import { Link, router } from '@inertiajs/vue3';
const logout = () => {
    router.post(route('logout'));
}
</script>

<script>
export default {
    props: {
        title: String,
        link: String,
        subLinks: Array,
        isOpen: Boolean,
        form: Boolean,
        method: String,
        currTab: String,
    },
    computed: {
        isCurrentPage() {
            const paths = ['/', '/login', '/register', '/patients'];
            return paths.includes(window.location.pathname);
        },
        highlightCurrPage() {
            return this.isCurrentPage || window.location.pathname.includes(this.currTab);
        },
    },
    methods: {
        toggleAccordion(index) {
            this.subLinks[index].isOpen = !this.subLinks[index].isOpen;
        },
        hightlightSubLinks(linkName) {
            return window.location.pathname.includes(linkName);
        },
    }
};
</script>

<template>
    <div class="mb-1 duration-300 ease-in-out active:bg-vsu-yellow rounded-md hover:shadow-lg hover:bg-vsu-olive">
        <template v-if="!form">
            <Link :href="route(link)" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md"
            :class="{'bg-vsu-yellow': highlightCurrPage}">
                <span class="w-4 h-auto">
                    <slot name="icon"></slot>
                </span>
                <span class="duration-300 ease-in-out text-sm" :class="isOpen?'opacity-0 absolute w-0':'opacity-100'">
                    <slot name="title"></slot>
                </span>
            </Link>
        </template>
        <template v-else-if="subLinks">
            <div v-for="(item, index) in subLinks" :key="index" class="rounded-md">
                <div :class="{'bg-vsu-yellow': highlightCurrPage,'w-fit flex-col items-center':isOpen,'bg-vsu-olive': item.isOpen,'bg-transparent': !item.isOpen,'rounded-t-lg': index === 0,'rounded-b-lg': index === subLinks.length - 1}"
                     class="flex justify-between cursor-pointer px-2 py-2 text-gray-100 rounded-md">
                    <Link :href="route(link)"  class="flex flex-row items-center gap-2 w-full" :class="{'justify-center': isOpen}">
                        <span class="w-4 h-auto">
                            <slot name="icon"></slot>
                        </span>
                        <span class="duration-300 ease-in-out text-sm" :class="isOpen?'opacity-0 absolute w-0':'opacity-100'">
                            <slot name="title"></slot>
                        </span>
                    </Link>
                    <button @click="toggleAccordion(index)" @focusout="item.isOpen = false" :title="item.isOpen?'Collapse':'Expand'" :class="{'transform rotate-180': item.isOpen}" class="transition-transform hover:scale-110 duration-300 active:scale-90" >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <transition enter-active-class="transition duration-500 ease-in-out"
                            enter-from-class="opacity-0"
                            enter-to-class="opacity-100"
                            leave-active-class="transition duration-500 ease-in-out"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0">
                    <div v-if="item.isOpen" class="flex z-50 flex-col bg-vsu-olive p-2 rounded-md mt-1" :class="{'absolute shadow-lg flex-row': isOpen}">
                        <Link v-for="content in item.content" :href="route(content.link)"
                              :class="{'bg-vsu-yellow': hightlightSubLinks(content.linkName)}"
                              class="text-white hover:bg-vsu-yellow py-0.5 px-2 rounded-sm whitespace-nowrap">
                            <span class="duration-300 ease-in-out text-sm" >
                                {{ content.name }}
                            </span>
                        </Link>
                    </div>
                </transition>
            </div>
        </template>
        <template v-else>
            <form @submit.prevent="logout">
                <button type="submit" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md">
                    <span class="w-4 h-auto">
                        <slot name="icon"></slot>
                    </span>
                    <span class="duration-300 ease-in-out text-sm" :class="[isOpen?'opacity-0 absolute w-0':'opacity-100',!isOpen?'opacity-100':'opacity-0 absolute w-0']">
                        <slot name="title"></slot>
                    </span>
                </button>
            </form>
        </template>
    </div>
</template>
