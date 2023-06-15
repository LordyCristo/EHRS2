<template>
    <Pie :data="data" :options="options" />
    <span class="font-medium text-2xl">{{ data.datasets[0].data.reduce((accumulator, currentValue) => accumulator + currentValue, 0) }} Records</span>
</template>

<script lang="ts">
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    Colors,
    ArcElement,
} from 'chart.js'
import { Bar, Pie } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement, Colors)

export default {
    name: 'App',
    components: {
        Pie,
    },
    props: {
        data: Object,
        options: Object,
    },
}
</script>
