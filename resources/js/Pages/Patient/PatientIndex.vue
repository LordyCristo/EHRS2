<script setup>
import Patients from '@/Pages/Patients.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';
import NotifBanner from '@/Components/Generic/Modals/NotifBanner.vue';
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
            index: 'api.patients',
            create: 'newPatient',
            store: 'api.patient.store',
            edit: 'editPatient',
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
                data: 'first_name',
                name: 'first_name',
                title: 'First Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'last_name',
                name: 'last_name',
                title: 'Surname',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'suffix',
                name: 'suffix',
                title: 'Suffix',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'sex',
                name: 'sex',
                title: 'Sex',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'client_type_id',
                name: 'client_type_id',
                title: 'Type',
                searchable: true,
                orderable: false,
                collapsable: false,
                className: 'dt-border-sm px-2',
            }
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
                data: 'first_name',
                name: 'first_name',
                title: 'First Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'middle_name',
                name: 'middle_name',
                title: 'Middle',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'last_name',
                name: 'last_name',
                title: 'Surname',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'suffix',
                name: 'suffix',
                title: 'Suffix',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'age',
                name: 'age',
                title: 'Age',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'sex',
                name: 'sex',
                title: 'Sex',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'civil_status',
                name: 'civil_status',
                title: 'Civil Status',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'client_type_id',
                name: 'client_type_id',
                title: 'Type',
                searchable: false,
                orderable: false,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
        ],
    }),
}
</script>

<template>
    <Patients title="Client Records">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        <NotifBanner :type="notifType" :message="notifMessage" />
    </Patients>
</template>
