<template>
    <div class="w-full p-3 max-h-min max-w-sm border rounded-lg shadow bg-gray-100 border-gray-100">
        <div class="flex justify-end">
            <button id="dropdownButton" data-dropdown-toggle="dropdown" @click="toggleDropdown" @focusout="closeDropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="absolute z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col items-center p-3 py-6">
            <span class="flex w-12 h-12 mb-1 text-gray-900 text-3xl items-center justify-center">
                <slot name="number" />
            </span>
            <h5 class="mb-1 text-xl font-medium text-gray-900"><slot name="title" /></h5>
            <span class="text-sm text-gray-700"><slot name="description" /></span>
            <div class="flex mt-4 w-full">
                <Link :href="mainbtnlink" class="items-center px-4 py-2 w-full text-center text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-vsu-olive hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-200">Manage</Link>
            </div>
        </div>
    </div>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";
</script>
<script>
export default {
    props: {
        mainbtnlink: {
            type: String,
            default: null
        },
    },
    methods: {
        toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        },
        closeDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.add('hidden');
        }
    }
}
</script>
