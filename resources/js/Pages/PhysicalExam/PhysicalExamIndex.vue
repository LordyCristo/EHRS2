<script setup>
import PhysicalExam from "@/Pages/PhysicalExam.vue";
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            // create form
            create: 'physicalexam.create',
            // edit form
            edit: 'physicalexam.edit',
            //view form
            //show: 'radiology.result.show',
            // return all data
            index: 'api.physicalexam.index',
            // return data compatible for datatable requests
            table: 'api.physicalexam.table',
            // store data from create form
            store: 'api.physicalexam.store',
            // update data from edit form
            update: 'api.physicalexam.update',
            // delete a specific data
            destroy: 'api.physicalexam.destroy',
            // import data from excel
            //import: 'api.radiology.result.import',
        },
        columnsSmall:[
            {
                data: 'id',
                name:'id',
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
                data: 'id',
                name:'id',
                title: 'Record ID',
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
        ],
    }),
}
</script>

<template>
    <PhysicalExam title="Physical Examination">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        </div>
    </PhysicalExam>
</template>


