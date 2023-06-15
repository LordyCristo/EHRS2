<template>
    <Pie :data="data" :options="options" type="doughnut" />
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
