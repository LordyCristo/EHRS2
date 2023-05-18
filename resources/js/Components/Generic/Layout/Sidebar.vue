<script setup>
import SidebarItem from "@/Components/Generic/Layout/SidebarItem.vue";
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { Link } from '@inertiajs/vue3';
import HamburgerIcon from "@/Components/Icons/HamburgerIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
</script>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        toggleOpen() {
            this.isOpen = !this.isOpen;
            localStorage.setItem('isOpen', this.isOpen);
        },
    },
    mounted() {
        this.isOpen = localStorage.getItem('isOpen') === 'true';
    },
}
</script>
<template>
    <div class="min-h-screen flex flex-row">
        <div :class="isOpen ? 'w-14' : 'w-48'" class="flex flex-col min-h-full duration-700 pt-5 px-1 bg-vsu-green shadow-md">
            <div class="flex flex-col">
                <div class="flex mb-2" :class="isOpen ? 'flex-col justify-center items-center' : 'justify-between px-2'">
                    <h2 class="sr-only">ELECTRONIC HEALTH RECORDS SYSTEM</h2>
                    <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-auto w-10" />
                    </Link>
                    <template v-if="!isOpen">
                        <button @click="toggleOpen" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md">
                            <CloseIcon class="w-6 h-auto hover:rotate-90 hover:scale-125 duration-300 ease-in-out"></CloseIcon>
                        </button>
                    </template>
                    <template v-else>
                        <button @click="toggleOpen" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md">
                            <HamburgerIcon class="w-6 h-auto"></HamburgerIcon>
                        </button>
                    </template>
                </div>
                <div class="flex flex-col" :class="isOpen ? 'justify-center items-center' : 'justify-between px-2'">
                    <SidebarItem v-for="item in items" :subLinks="item.subLinks" :link="item.link" :form="item.form"
                        :method="item.method" :isOpen="isOpen" :currTab="item.tabName">
                        <template #icon>
                            <component :is="item.icon" />
                        </template>
                        <template  #title>
                            {{ item.title }}
                        </template>
                    </SidebarItem>
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1">
            <!-- The body of the page which include the toolbar and the content -->
            <slot name="body"></slot>
        </div>
    </div>
</template>
