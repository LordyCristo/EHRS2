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
import {Sex} from "@/Legends/legends";
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
            optionsBarchart: {
                responsive: true,
                plugins: {
                    //display the legends
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Records per College'
                    },
                    // automatically assign colors
                    colors: {
                        enabled: true,
                    }
                }
            },
            optionsPieChart: {
                responsive: true,
                plugins: {
                    //display the legends
                    legend: {
                        display: true,
                        position: 'right',
                    },
                    title: {
                        display: false,
                        text: 'Records per College',
                    },
                    // automatically assign colors
                    colors: {
                        enabled: true,
                    }
                }
            },
            getByTable: 'colleges',
            getBySpecific: null,
            getGroupBy: '*',
            getSpecific: 'BSCS',
            byColumn: [],
            pieChartData: [],
            barChartData: [],
        }
    },
    methods: {
        async fetchData() {
            const response = await axios(route('api.monthly.summary'), {
                params: {
                    getByTable: this.getByTable,
                    getBySpecific: this.getBySpecific,
                    getGroupBy: this.getGroupBy,
                    getSpecific: this.getSpecific,
                }
            });
            this.data = await response.data;
            this.byColumn = this.data.hematology.labels.map((label, index) => ({ id: index, name: label }))
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
                Summary of Records for Students
            </h2>
            <div class="grid grid-cols-3">
                <SelectElement v-model="getByTable" :options="[
                    {id: 'colleges', name: 'College'},
                    //{id: 'departments', name: 'Department'},
                    {id: 'degree_programs', name: 'Program'},
                    // {id: 'sex', name:'Sex'},
                ]" label="By"
                                   @change="fetchData"
                />
                <SelectElement @change="fetchData" v-model="getGroupBy" :options="[
                    {id: '*', name: 'All'},
                    {id: 'sex', name:'Sex'},
                    {id: 'civil_status', name: 'Civil Status'},
                    {id: 'year_lvl', name: 'Year Level'},
                ]" label="Group By" />
            </div>
            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Registered Students</h1>
                    <div v-if="data.client" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.client" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.hematology" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.hematology" :options="optionsPieChart"></PieChart>
                </div>
            </div>

            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Clients with Hematology Record</h1>
                    <div v-if="data.hematology" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.hematology" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.hematology" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.hematology" :options="optionsPieChart"></PieChart>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Clients with Fecalysis Record</h1>
                    <div v-if="data.fecalysis" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.fecalysis" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.fecalysis" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.fecalysis" :options="optionsPieChart"></PieChart>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Clients with Urinalysis Record</h1>
                    <div v-if="data.urinalysis" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.urinalysis" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.urinalysis" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.urinalysis" :options="optionsPieChart"></PieChart>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Clients with Radiology Record</h1>
                    <div v-if="data.radiology" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.radiology" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.radiology" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.radiology" :options="optionsPieChart"></PieChart>
                </div>
            </div>
            <div class="flex flex-row items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="font-bold">Number of Clients with Dental Record</h1>
                    <div v-if="data.dental" class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                        <BarChart :data="data.dental" :options="optionsBarchart"></BarChart>
                    </div>
                </div>
                <div v-if="data.dental" class="h-auto px-4 py-5 bg-white rounded-lg text-center">
                    <PieChart :data="data.dental" :options="optionsPieChart"></PieChart>
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
