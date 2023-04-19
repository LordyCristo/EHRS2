<template>
    <Pie :data="data" :options="options" />
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
    ArcElement,
} from 'chart.js'
import { Bar, Pie } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement)

export default {
    name: 'App',
    components: {
        Bar,
        Pie,
    },
    data() {
        return {
            data: {
                labels: [
                    'Male',
                    'Female',
                ],
                datasets: [{
                    label: 'Sex',
                    data: [300, 220],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true
            }
        }
    }
}
</script>
