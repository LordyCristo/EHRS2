<script setup>
import BackIcon from '@/Components/Icons/BackIcon.vue';
import { Head, Link, router } from '@inertiajs/vue3';
</script>
<script>
export default {
    components: {
        BackIcon,
        Link,
    },
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
    methods: {
        goBack() {
            router.back();
        },
    },
}
</script>
<template>
    <ul class="flex flex-row gap-2 my-2 text-sm ">
        <li class="flex items-center ml-2 hover:scale-125 duration-300 hover:text-vsu-yellow">
            <Link :href="route(items[0].href)" @click.prevent="{ goBack }" class="w-5">
                <BackIcon></BackIcon>
            </Link>
        </li>
        <li v-for="item in items" :key="item.title" class="flex gap-2 " :class="{ 'hidden': item.disabled }">
            <Link :href="route(item.href)" class="hover:text-vsu-yellow duration-200">
                {{ item.title }}
            </Link>
            <span>/</span>
        </li>
    </ul>
</template>
