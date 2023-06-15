<script setup>
import '@/loader.js'; // Google Charts
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
            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
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
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(this.drawChart);
    }
}
</script>
<template>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
</template>
