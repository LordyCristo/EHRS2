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
                data: 'abbr',
                name: 'abbr',
                title: 'Abbreviation',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'major',
                name: 'major',
                title: 'Major',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'group',
                name: 'group',
                title: 'Level',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'department_id',
                name: 'department_id',
                title: 'Department',
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
                data: 'abbr',
                name: 'abbr',
                title: 'Abbreviation',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'department_id',
                name: 'department_id',
                title: 'Department',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        apiLink: {
            // create form
            create: 'more.program.create',
            // edit form
            edit: 'more.program.edit',
            // return all data
            index: 'api.program.index',
            // return data compatible for datatable requests
            table: 'api.program.table',
            // store data from create form
            store: 'api.program.store',
            // update data from edit form
            update: 'api.program.update',
            // delete a specific data
            destroy: 'api.program.destroy',
            // import data from excel
            import: 'api.program.import',
        },
    })
}
</script>
