<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import PieChart from '@/Components/Generic/Charts/PieChart.vue';
import Pie from '@/Components/Generic/Charts/Pie.vue';
let data = ref({
    labels: null,
    datasets: [{
        label: 'Sex',
        data: null,
        backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',
        ],
        hoverOffset: 4
    }]
});
onMounted(async () => {
    await fetch(route('api.dashboard'))
        .then((response) => response.json())
        .then((d) => {
            data.value = d;
            // data.value.labels = data.value.charts.groupBy_sex.map(obj => obj.sex);
            // data.value.datasets.data = data.value.charts.groupBy_sex.map(obj => obj.count);
            // console.log(data.value);
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
                        <div v-for="item in data.cards" class="w-full px-4 py-5 bg-white rounded-lg">
                            <div class="text-sm font-medium text-center text-gray-500 truncate">
                                {{ item[0] }}
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">
                                {{ item[1] }}
                            </div>
                        </div>
                        <div class="w-full px-4 py-5 bg-white rounded-lg">
                            <div class="text-sm font-medium text-center text-gray-500 truncate">
                                Clients Count by Sex
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">
                                <PieChart></PieChart>
                            </div>
                        </div>
                        <div class="w-full px-4 py-5 bg-white rounded-lg">
                            <div class="text-sm font-medium text-center text-gray-500 truncate">
                                Clients Count by Sex
                            </div>
                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">
                                <Pie></Pie>
                            </div>
                        </div>
                    </div>
                    <div class="w-56 mx-auto">

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
