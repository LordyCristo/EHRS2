<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PieChart from '@/Components/Generic/Charts/PieChart.vue';
import Pie from '@/Components/Generic/Charts/Pie.vue';
import BarChart from '@/Components/Generic/Charts/BarChart.vue';
import Card from "@/Components/Generic/Dashboard/Card.vue";
import CardSection from "@/Components/Generic/Dashboard/CardSection.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
</script>
<script>
export default {
    props: {
        labels: null,
        cards: Object,
        charts: Object,
    },
    data(){
        return {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [],
            },
            options: {
                responsive: true,
                plugins: {
                    //display the legends
                    legend: {
                        display: true,
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Records per College'
                    },
                    // automatically assign colors
                    colors: {
                        enabled: true
                    }
                }
            },
            getBy: 'colleges',
        }
    },
    methods: {
        async fetchData() {
            const response = await axios(route('api.monthly.summary'), {
                params: {
                    getBy: this.getBy,
                }
            });
            this.data = await response.data;

            console.log(this.barGraphData);
        }
    },
    mounted() {
        this.fetchData();
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col">
            <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                Summary of Records for Student
            </h2>
            <SelectElement v-model="getBy" :options="[
                {id: 'colleges', name: 'College'},
                //{id: 'departments', name: 'Department'},
                {id: 'degree_programs', name: 'Program'},
                {id: 'sex', name:'Sex'},
            ]" label="By"
               @change="fetchData"
            />
            <button @click="fetchData" class="fixed bottom-3 right-3 bg-vsu-green px-2 py-1 rounded-md shadow-md">Refresh</button>
            <div v-if="data.hematology" class="w-[70rem] h-auto px-4 py-5 bg-white rounded-lg">
                <BarChart :data="data.hematology" :options="options"></BarChart>
            </div>
            <div class="grid grid-cols-3">
                <div v-if="data.hematology" class="w-[20rem] h-auto px-4 py-5 bg-white rounded-lg">
                    <PieChart :data="data.hematology" :options="options"></PieChart>
                </div>
                <div v-if="data.fecalysis" class="w-[20rem] h-auto px-4 py-5 bg-white rounded-lg">
                    <PieChart :data="data.fecalysis" :options="options"></PieChart>
                </div>
                <div v-if="data.urinalysis" class="w-[20rem] h-auto px-4 py-5 bg-white rounded-lg">
                    <PieChart :data="data.urinalysis" :options="options"></PieChart>
                </div>
                <div v-if="data.radiology" class="w-[20rem] h-auto px-4 py-5 bg-white rounded-lg">
                    <PieChart :data="data.radiology" :options="options"></PieChart>
                </div>
            </div>


            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3 my-5 w-full">
                    <CardSection :cards="cards" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
