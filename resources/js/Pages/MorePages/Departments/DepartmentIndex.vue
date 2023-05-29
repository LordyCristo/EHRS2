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
                data: 'college_id',
                name: 'college_id',
                title: 'College',
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
                data: 'college_id',
                name: 'college_id',
                title: 'College',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        apiLink: {
            // create form
            create: 'more.department.create',
            // edit form
            edit: 'more.department.edit',
            // return all data
            index: 'api.department.index',
            // return data compatible for datatable requests
            table: 'api.department.table',
            // store data from create form
            store: 'api.department.store',
            // update data from edit form
            update: 'api.department.update',
            // delete a specific data
            destroy: 'api.department.destroy',
            // import data from excel
            import: 'api.department.import',
        },
    })
}
</script>
