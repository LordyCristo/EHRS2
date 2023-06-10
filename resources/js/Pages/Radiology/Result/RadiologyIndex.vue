<script setup>
import Radiology from '@/Pages/Radiology.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            // create form
            create: 'radiology.result.create',
            // edit form
            edit: 'radiology.result.edit',
            //view form
            show: 'radiology.result.show',
            // return all data
            index: 'api.radiology.result.index',
            // return data compatible for datatable requests
            table: 'api.radiology.result.table',
            // store data from create form
            store: 'api.radiology.result.store',
            // update data from edit form
            update: 'api.radiology.result.update',
            // delete a specific data
            destroy: 'api.radiology.result.destroy',
            // import data from excel
            import: 'api.radiology.result.import',
        },
        columnsSmall:[
            {
                data: 'rqst_id',
                name:'rqst_id',
                title: 'Record No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2 text-center'
            },
            {
                data: 'infirmary_id',
                name:'infirmary_id',
                title: 'Infirmary ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2 text-center'
            },
            {
                data: 'or_no',
                name: 'or_no',
                title: 'OR No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'rqst_physician',
                name: 'rqst_physician',
                title: 'Physician',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 text-center',
            },
        ],
        columnsLarge: [
            {
                data: 'rqst_id',
                name:'rqst_id',
                title: 'Request ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2 text-center'
            },
            {
                data: 'infirmary_id',
                name:'infirmary_id',
                title: 'Infirmary ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2 text-center'
            },
            {
                data: 'name',
                name: 'name',
                title: 'Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 ',
            },
            {
                data: 'status',
                name: 'status',
                title: 'Status',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 uppercase',
            },
        ],
    }),
}
</script>

<template>
    <Radiology title="Radiology Results">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        </div>
    </Radiology>
</template>


