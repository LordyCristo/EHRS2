<script setup>
import Dental from "@/Pages/Dental.vue";
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            // create form
            create: 'dental.treatment.create',
            // edit form
            edit: 'dental.treatment.edit',
            //view form
            show: 'dental.treatment.show',
            // return all data
            index: 'api.dental.treatment.index',
            // return data compatible for datatable requests
            table: 'api.dental.treatment.table',
            // store data from create form
            store: 'api.dental.treatment.store',
            // update data from edit form
            update: 'api.dental.treatment.update',
            // delete a specific data
            destroy: 'api.dental.treatment.destroy',
            // import data from excel
            import: 'api.dental.treatment.import',
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
                data: 'id',
                name:'id',
                title: 'Dental ID',
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
                data: 'treatment_count',
                name: 'treatment_count',
                title: 'Treatments Count',
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
    <Dental title="Dental">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink"/>
        </div>
    </Dental>
</template>
