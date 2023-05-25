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
                title: 'Record No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'client_id',
                name:'client_id',
                title: 'Client ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'or_no',
                name: 'or_no',
                title: 'OR No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'rqst_physician',
                name: 'rqst_physician',
                title: 'Physician',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        columnsLarge: [
            {
                data: 'id',
                name:'id',
                title: 'Record No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'client_id',
                name:'client_id',
                title: 'Client ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'age',
                name: 'age',
                title: 'Age',
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
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'ward',
                name: 'ward',
                title: 'Ward',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'or_no',
                name: 'or_no',
                title: 'OR No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'rqst_physician',
                name: 'rqst_physician',
                title: 'Physician',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
    }),
}
</script>

<template>
    <Laboratory title="Laboratories">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
            <NotifBanner :type="notifType" :message="notifMessage" />
        </div>
    </Laboratory>
</template>
