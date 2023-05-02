<script setup>
import '@/loader.js'; // Google Charts

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Male', 11],
        ['Female', 9],
    ]);

    var options = {
        //title: 'Client Count by sex',
        //is3D: true,
        pieHole: 0.2,
        legend: 'none', //hide legend
        pieSliceText: 'label', //place the label in the slice
        pieStartAngle: 135, // use to rotate the chart
        tooltip: { trigger: 'none' }, //hide or show tooltip
        // Specify the color of the slices
        // slices: {
        //     0: { color: 'yellow' },
        //     1: { color: 'transparent' }
        // }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}
</script>
<template>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</template>
