<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';

let data = ref({});
onMounted(async () => {
    await fetch(route('api.dashboard'))
    .then((response) => response.json())
    .then((d) => {
        data.value = d;
        console.log(data.value);
    });
})();
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
                        <div v-for="item in data" class="w-full px-4 py-5 bg-white rounded-lg">
                            <div class="text-sm font-medium text-center text-gray-500 truncate">
                                {{ item[0] }}
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">
                                {{ item[1] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
