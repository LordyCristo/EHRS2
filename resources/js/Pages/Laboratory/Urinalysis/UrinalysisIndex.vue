<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            // create form
            create: 'laboratory.urinalysis.create',
            // edit form
            edit: 'laboratory.urinalysis.edit',
            //view form
            show: 'laboratory.urinalysis.show',
            // return all data
            index: 'api.urinalysis.index',
            // return data compatible for datatable requests
            table: 'api.urinalysis.table',
            // store data from create form
            store: 'api.urinalysis.store',
            // update data from edit form
            update: 'api.urinalysis.update',
            // delete a specific data
            destroy: 'api.urinalysis.destroy',
            // import data from excel
            import: 'api.urinalysis.import',
        },
        columnsSmall:[
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
                data: 'ward',
                name: 'ward',
                title: 'Ward',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 uppercase text-center',
            },
            {
                data: 'status',
                name: 'status',
                title: 'Status',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 uppercase text-center',
            },
        ],
    }),
}
</script>

<template>
    <Laboratory title="Urinalysis">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        </div>
    </Laboratory>
</template>
