<template>
    <MorePages title="Colleges">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" />
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import DataTable from "@/Components/DataTable/DataTable.vue";
import NotifBanner from "@/Components/Generic/Modals/NotifBanner.vue";
</script>
<script>
export default{
    data: () => ({
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
                data: 'name',
                name: 'name',
                title: 'Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'schedule',
                name: 'schedule',
                title: 'Schedule',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'room_no',
                name: 'room_no',
                title: 'Room No.',
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
                title: 'ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2 max-w-xs truncate'
            },
            {
                data: 'name',
                name: 'name',
                title: 'Name',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2 max-w-xs truncate',
            },
            {
                data: 'description',
                name: 'description',
                title: 'Description',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 max-w-xs truncate',
            },
            {
                data: 'schedule',
                name: 'schedule',
                title: 'Schedule',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 max-w-xs truncate',
            },
            {
                data: 'section_name',
                name: 'section_name',
                title: 'Section Name',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 max-w-xs truncate',
            },
            {
                data: 'room_no',
                name: 'room_no',
                title: 'Room No.',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 max-w-xs truncate',
            },
        ],
        apiLink: {
            // create form
            create: 'more.service.create',
            // edit form
            edit: 'more.service.edit',
            // return all data
            index: 'api.service.index',
            // return data compatible for datatable requests
            table: 'api.service.table',
            // store data from create form
            store: 'api.service.store',
            // update data from edit form
            update: 'api.service.update',
            // delete a specific data
            destroy: 'api.service.destroy',
            // import data from excel
            import: 'api.service.import',
        },
    })
}
</script>
