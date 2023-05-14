<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
const logout = () => {
    router.post(route('logout'));
}
</script>

<script>
export default {
    props: {
        title: String,
        link: String,
        hasSubLinks: Boolean,
        subLinks: Array,
        isOpen: Boolean,
        form: Boolean,
        method: String,
        currTab: String,
        isOpen: Boolean,
    },
    computed: {
        isHomePage() {
            return window.location.pathname === '/';
        },
        isLoginPage() {
            return window.location.pathname === '/login';
        },
        isRegisterPage() {
            return window.location.pathname === '/register';
        },
        isPatientsPage() {
            return window.location.pathname === '/patients';
        },
        currPage() {
            return window.location.pathname;
        },
    },
};
</script>

<template>
    <div class="mb-1 hover:bg-vsu-olive duration-300 ease-in-out active:bg-vsu-yellow rounded-md hover:shadow-lg">
        <template v-if="!form">
            <Link :href="route(link)" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md"
            :class="{'bg-vsu-yellow': currPage === currTab}">
                <span class="w-4 h-auto">
                    <slot name="icon"></slot>
                </span>
                <span class="duration-300 ease-in-out text-sm" :class="{'opacity-0 absolute w-0': isOpen, 'opacity-100':!isOpen}">
                    <slot name="title"></slot>
                </span>
            </Link>
        </template>
        <template v-else>
            <form @submit.prevent="logout">
                <button type="submit" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md">
                    <span class="w-4 h-auto">
                        <slot name="icon"></slot>
                    </span>
                    <span class="duration-300 ease-in-out text-sm" :class="{'opacity-0 absolute w-0': isOpen, 'opacity-100':!isOpen}">
                        <slot name="title"></slot>
                    </span>
                </button>
            </form>
        </template>
    </div>
</template>
