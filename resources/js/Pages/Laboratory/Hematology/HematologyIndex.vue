<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
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
        apiLink: {
            // create form
            create: 'laboratory.hematology.create',
            // edit form
            edit: 'laboratory.hematology.edit',
            // return all data
            index: 'api.hematology.index',
            // return data compatible for datatable requests
            table: 'api.hematology.table',
            // store data from create form
            store: 'api.hematology.store',
            // update data from edit form
            update: 'api.hematology.update',
            // delete a specific data
            destroy: 'api.hematology.destroy',
            // import data from excel
            import: 'api.hematology.import',
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
                data: 'hemoglobin',
                name: 'hemoglobin',
                title: 'Hemoglobin',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'hematocrit',
                name: 'hematocrit',
                title: 'Hematocrit',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'wbc',
                name: 'wbc',
                title: 'WBC',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'rbc',
                name: 'rbc',
                title: 'RBC',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'platelet_count',
                name: 'platelet_count',
                title: 'Platelet Count',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'segmenters',
                name: 'segmenters',
                title: 'Segmenters',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'lymphocyte',
                name: 'lymphocyte',
                title: 'Lymphocyte',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'monocyte',
                name: 'monocyte',
                title: 'Monocyte',
                searchable: false,
                orderable: false,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'blood_type',
                name: 'blood_type',
                title: 'Blood Type',
                searchable: false,
                orderable: false,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'status',
                name: 'status',
                title: 'Status',
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
    <Laboratory title="Laboratories">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        <NotifBanner :type="notifType" :message="notifMessage" />
    </Laboratory>
</template>
