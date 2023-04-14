<script setup>
const logout = () => {
    router.post(route('logout'));
}
</script>

<script>
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

export default {
    name: "Dropdown",
    props: {
        title: String,
        link: String,
        hasSubLinks: Boolean,
        subLinks: Array,
        isOpen: Boolean,
        form: Boolean,
        method: String,
    },
    data() {
        return {
            showSubLinks: false,
        };
    },
    components: { NavLink, Link, Head, router },
    watch: {
        isOpen: function (newValue, oldValue) {
            this.showSubLinks = newValue;
        }
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
    },
};
</script>

<template>
    <div
        class="mb-1 hover:bg-vsu-olive transition-colors duration-300 ease-in-out active:bg-vsu-yellow rounded-md hover:shadow-lg">
        <template v-if="!form">
            <Link :href="route(link)" class="flex flex-row items-center gap-2 text-gray-100 p-2 rounded-md">
            <span class="w-4 h-auto">
                <slot name="icon"></slot>
            </span>
            <slot name="title"></slot>
            </Link>
        </template>
        <template v-else>
            <form @submit.prevent="logout">
                <button type="submit" class="flex flex-row items-center gap-2 w-full text-gray-100 p-2 rounded-md">
                    <span class="w-4 h-auto">
                        <slot name="icon"></slot>
                    </span>
                    <slot name="title"></slot>
                </button>
            </form>
        </template>
    </div>
</template>
