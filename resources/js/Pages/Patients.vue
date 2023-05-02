<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolbarPatient from '@/Pages/Patient/ToolbarPatient.vue';
</script >
<script>
export default {
    computed: {
        isPatientsPage() {
            return window.location.pathname === '/patients';
        }
    },
    methods: {
        deleteItem(id) {
            console.log(id);
        }
    },
    data: () => ({
        items: [
            {
                title: 'Patients',
                disabled: true,
                href: 'patients',
            },
            {
                title: 'New Patient',
                disabled: false,
                href: 'newPatient',
            },
            {
                title: 'Edit Patient',
                disabled: false,
                href: 'editPatient',
            },
        ],
    }),
}
</script>
<template>
    <AppLayout title="Patients">
        <template #toolbar>
            <ToolbarPatient></ToolbarPatient>
        </template>
        <slot></slot>
    </AppLayout>
</template>
<style>
@import 'datatables.net-select-bs5';
@import 'datatables.net-bs5';
@import 'datatables.net-responsive-dt';
@import 'datatables.net-select-dt';
@import 'datatables.net-dt';

.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_length {
    @apply text-sm text-gray-600 sm:w-1/2 p-1 mt-1;
}

.dataTables_wrapper .dataTables_filter {
    @apply float-right;
}

.dataTables_wrapper .dataTables_length {
    @apply float-left bg-transparent;
}

.dataTables_wrapper .dataTables_filter input,
.dataTables_wrapper .dataTables_length select {
    @apply p-1 w-full border overflow-ellipsis text-sm rounded-sm focus:border-vsu-olive focus:ring focus:ring-indigo-200 focus:ring-opacity-50 duration-300;
}

.dataTables_wrapper .dataTables_length select {
    @apply pr-7 text-center;
}

.dataTables_wrapper thead {
    @apply bg-gray-200;
}

.dataTables_wrapper thead tr th {
    @apply text-sm text-gray-900 font-semibold p-2 text-center whitespace-nowrap;
}

.dataTables_wrapper tbody tr {
    @apply text-sm text-gray-900 hover:bg-gray-100 active:bg-gray-400 duration-200;
}

.dataTables_wrapper tbody tr td {
    @apply p-1 text-center;
}

.dataTables_wrapper tbody tr:hover {
    @apply cursor-pointer;
}

.dataTables_wrapper .dataTables_scrollBody {
    @apply shadow-inner border-y-2;
}

.dataTables_wrapper .dataTables_info {
    @apply float-left text-sm;
}

.dataTables_wrapper .dataTables_paginate {
    @apply float-right p-2;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    @apply px-2 py-1 text-sm rounded-sm border border-gray-300 hover:bg-gray-200 active:bg-gray-400 duration-200;
}
</style>