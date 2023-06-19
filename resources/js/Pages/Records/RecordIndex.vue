<script setup>
import MedicalRecords from "@/Pages/MedicalRecords.vue";
import DataTable from '@/Components/DataTable/DataTable.vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            // create form
            //create: 'radiology.result.create',
            // edit form
            //edit: 'radiology.result.edit',
            //view form
            show: 'records.show',
            // return all data
            index: 'api.record.export',
            // return data compatible for datatable requests
            table: 'api.record.index',
            // store data from create form
            store: 'api.radiology.result.store',
            // update data from edit form
            update: 'api.radiology.result.update',
            // delete a specific data
            //destroy: 'api.radiology.result.destroy',
            // import data from excel
            import: 'api.radiology.result.import',
        },
        columnsLarge: [
            {
                data: 'infirmary_id',
                name:'infirmary_id',
                title: 'Infirmary ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm text-center px-2'
            },
            {
                data: 'name',
                name: 'name',
                title: 'Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'hematology_count',
                name: 'hematology_count',
                title: 'Hematology',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'fecalysis_count',
                name: 'fecalysis_count',
                title: 'Fecalysis',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'urinalysis_count',
                name: 'urinalysis_count',
                title: 'Urinalysis',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'xray_count',
                name: 'xray_count',
                title: 'Xray',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'dental_count',
                name: 'dental_count',
                title: 'Dental',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
            {
                data: 'physical_exam_count',
                name: 'physical_exam_count',
                title: 'Physical Exam',
                searchable: false,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 text-center',
            },
        ],
    }),
}
</script>

<template>
    <MedicalRecords title="Medical Records">
        <div class="flex flex-col w-full">
            <DataTable :columnsLarge="columnsLarge" :apiLink="apiLink"/>
        </div>
    </MedicalRecords>
</template>
