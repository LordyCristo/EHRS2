<script setup>
import '@/loader.js';
</script>
<script>
export default {
    props: {
        data: Array,
        options: Object,
    },
    methods: {
        drawChart() {
            var data = google.visualization.arrayToDataTable(this.data);
            var options = this.options;
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    },
    watch: {
        data() {
            this.drawChart();
        },
        options() {
            this.drawChart();
        }
    },
    mounted() {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(this.drawChart);
    }
}
</script>
<template>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</template>
