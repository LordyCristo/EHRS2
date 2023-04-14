<script>
import { Head } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Hamburger from '@/Components/Hamburger.vue';

export default {
    components: {
        ApplicationMark,
        Dropdown,
        DropdownLink,
        Head,
        Hamburger,
        NavLink,
        ResponsiveNavLink,
    },
}
</script>

<template>
    <nav class="min-w-full flex items-center">
        <slot></slot>
    </nav>
</template>
