<script setup>
import MedicalRecords from "@/Pages/MedicalRecords.vue";
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    props: {
        notifMessage: {
            type: String,
            required: false,
        },
        notifType: {
            type: String,
            required: false,
        },
    },
    data: () => ({
        options:{
            addBtn: true,
            deleteBtn: true,
            selectAllBtn: true,
            refreshBtn: true,
            printBtn: true,
            excelBtn: true,
            viewBtn: true,
            searchBtn: true,
        },
        apiLink: {
            index: 'api.programs',
            create: 'newRecord',
            store: 'api.patient.store',
            edit: 'editRecord',
            update: 'api.patient.update',
            destroy: 'api.patient.destroy',
            getall: 'api.patient.all',
            import: 'api.patient.import',
        },
        columnsSmall:[
            {
                data: 'id',
                name:'id',
                title: 'ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'abbr',
                name: 'abbr',
                title: 'Abbreviation',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'major',
                name: 'major',
                title: 'Major',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
        ],
        columnsLarge: [
            {
                data: 'id',
                name:'id',
                title: 'ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'name',
                name: 'name',
                title: 'Program Description',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'abbr',
                name: 'abbr',
                title: 'Abbreviation',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'major',
                name: 'major',
                title: 'Major',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'department_id',
                name: 'department_id',
                title: 'Department',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
        ],
    }),
}
</script>

<template>
    <MedicalRecords title="Medical Records">
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="row">
                        <data-table :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" ></data-table>
                    </div>
                </div>
            </div>
        </div>
    </MedicalRecords>
</template>
