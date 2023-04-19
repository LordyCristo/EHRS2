<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-dt';

DataTable.use(DataTablesCore);
defineProps({
    columns: {
        type: Array,
        required: true,
    },
});

const options = {
    responsive: true,
    select: true,
    editable: true,
    serverSide: true,
    processing: true,
    stateSave: true,
    scrollX: true,
    scrollY: '75vh',
    deferRender: true,
    paging: true,
    destroy: true,
    ajax: {
        url: route('api.patients'),
        type: 'GET',
    },
    pageLength: 20,
    lengthMenu: [
        [20, 50, 100],
        [20, 50, 100],
    ],
    order: [[0, 'desc']],
    language: {
        search: 'Search:',
        info: 'Showing _START_ to _END_ of _TOTAL_ entries',
        infoFiltered: '(filtered from _MAX_ total entries)',
        infoEmpty: 'No data to show',
        lengthMenu: 'Show _MENU_ entries',
        zeroRecords: 'No matching records found',
        paginate: {
            first: 'First',
            last: 'Last',
            next: 'Next',
            previous: 'Previous',
        },
    },
};

</script>

<style>
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        @apply text-sm text-gray-600 sm:w-1/2 p-1;
    }

    .dataTables_wrapper .dataTables_filter {
        @apply float-right;
    }

    .dataTables_wrapper .dataTables_length {
        @apply float-left;
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select{
        @apply p-1 w-full border overflow-ellipsis text-sm rounded-sm focus:border-vsu-olive focus:ring focus:ring-indigo-200 focus:ring-opacity-50 duration-300;
    }

    .dataTables_wrapper .dataTables_length select{
        @apply pr-7 text-center;
    }

    .dataTables_wrapper thead{
        @apply bg-gray-200;
    }

    .dataTables_wrapper thead tr th{
        @apply text-sm text-gray-900 font-semibold p-2 text-center whitespace-nowrap;
    }

    .dataTables_wrapper tbody tr{
        @apply text-sm text-gray-900 hover:bg-gray-100 active:bg-gray-400 duration-200;
    }

    .dataTables_wrapper tbody tr td{
        @apply p-1 text-center;
    }

    .dataTables_wrapper tbody tr:hover{
        @apply cursor-pointer;
    }

    .dataTables_wrapper .dataTables_scrollBody{
        @apply shadow-inner border-y-2;
    }

    .dataTables_wrapper .dataTables_info{
        @apply float-left;
    }

    .dataTables_wrapper .dataTables_paginate{
        @apply float-right p-2;
    }

</style>
<template>
    <DataTable id="patients_dt" :columns="columns" :options="options"></DataTable>
</template>
