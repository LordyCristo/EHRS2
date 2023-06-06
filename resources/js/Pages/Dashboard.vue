<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';
import PieChart from '@/Components/Generic/Charts/PieChart.vue';
import Pie from '@/Components/Generic/Charts/Pie.vue';
import Card from "@/Components/Generic/Dashboard/Card.vue";
import CardSection from "@/Components/Generic/Dashboard/CardSection.vue";
</script>
<script>
export default {
    props: {
        labels: null,
        datasets: [{
            label: 'Sex',
            data: null,
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(255, 99, 132)',
            ],
            hoverOffset: 4
        }],
        cards: Object,
        charts: Object,
    },
    mounted() {
        console.log(this.cards);
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="w-full">
            <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                Summary of Records for Student
            </h2>
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3 my-5 w-full">
                    <CardSection :cards="cards" />
<!--                        <div class="w-full px-4 py-5 bg-white rounded-lg">-->
<!--                            <div class="text-sm font-medium text-center text-gray-500 truncate">-->
<!--                                Clients Count by Sex-->
<!--                            </div>-->
<!--                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">-->
<!--                                <PieChart></PieChart>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="w-full px-4 py-5 bg-white rounded-lg">-->
<!--                            <div class="text-sm font-medium text-center text-gray-500 truncate">-->
<!--                                Clients Count by Sex-->
<!--                            </div>-->
<!--                            <div class="mt-1 text-3xl font-semibold text-center text-gray-900">-->
<!--                                <Pie></Pie>-->
<!--                            </div>-->
<!--                        </div>-->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
