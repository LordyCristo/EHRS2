<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PieChart from '@/Components/Generic/Charts/PieChart.vue';
import BarChart from '@/Components/Generic/Charts/BarChart.vue';
import Card from "@/Components/Generic/Dashboard/Card.vue";
import CardSection from "@/Components/Generic/Dashboard/CardSection.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import BarChartGoogle from "@/Components/Generic/Charts/BarChartGoogle.vue";
import LineChartGoogle from "@/Components/Generic/Charts/LineChartGoogle.vue";
import PieChartGoogle from "@/Components/Generic/Charts/PieChartGoogle.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
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
            getByTable: 'colleges',
            getByColumn: 'sex',
            pieChartData: [],
            barChartData: [],
        }
    },
    methods: {
        async fetchData() {
            const response = await axios(route('api.monthly.summary'), {
                params: {
                    getByTable: this.getByTable,
                    getByColumn: this.getByColumn,
                }
            });
            this.data = await response.data;
        },
        async fetchPieChartData() {
            const response = await axios(route('api.summary'), {
                params: {
                    getBy: this.getByTable,
                }
            });
            this.pieChartData = response.data;
        },
        async fetchBarChartData() {
            const response = await axios(route('api.monthly'), {
                params: {
                    getBy: this.getByTable,
                }
            });
            this.barChartData = response.data;
            console.log(response.data);
        },
    },
    mounted() {
        this.fetchData();
        // this.fetchPieChartData();
        // this.fetchBarChartData();
        // console.log(this.barChartData);
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col justify-center">
            <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                Summary of Records for Student
            </h2>
            <SelectElement v-model="getByTable" :options="[
                {id: 'colleges', name: 'College'},
                //{id: 'departments', name: 'Department'},
                {id: 'degree_programs', name: 'Program'},
                // {id: 'sex', name:'Sex'},
            ]" label="By"
                           @change="fetchData"
            />
            <SelectElement  @change="fetchData" v-if="data.length" v-model="getByColumn" :options="data.hematology.labels.map((label, index) => ({ id: index, name: label }))" label="Type" />

            {{data.hematology}}

            <!--            <PieChartGoogle :options="{title: 'Medical Records',}" :data="pieChartData" class="mx-auto" />-->
<!--            <BarChartGoogle :options="{-->
<!--        chart: {-->
<!--            title: 'Hispoital Revenue',-->
<!--            subtitle: 'Revenue Per Section: Monthly',-->
<!--        },-->
<!--        bars: 'vertical', // Required for Material Bar Charts.-->
<!--    }" :data="barChartData" />-->
<!--            <LineChartGoogle />-->

            <button @click="fetchPieChartData" class="fixed bottom-3 right-3 bg-vsu-green px-2 py-1 rounded-md shadow-md">Refresh</button>
            <div v-if="data.hematology" class="w-[70rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                <BarChart :data="data.hematology" :options="options"></BarChart>
            </div>
            <div class="grid grid-cols-2">
                <div v-if="data.hematology" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.hematology" :options="options"></PieChart>
                </div>
                <div v-if="data.fecalysis" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.fecalysis" :options="options"></PieChart>
                </div>
                <div v-if="data.urinalysis" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.urinalysis" :options="options"></PieChart>
                </div>
                <div v-if="data.radiology" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
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
