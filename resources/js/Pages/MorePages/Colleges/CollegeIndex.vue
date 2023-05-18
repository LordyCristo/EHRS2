<template>
    <MorePages title="Colleges">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" />
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import DataTable from "@/Components/DataTable/DataTable.vue";
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
                title: 'College Name',
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
                title: 'College Name',
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
                data: 'is_active',
                name: 'is_active',
                title: 'Active',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        apiLink: {
            index: 'api.colleges',
            create: 'more.newCollege',
            store: 'api.patient.store',
            edit: 'editPatient',
            update: 'api.patient.update',
            destroy: 'api.patient.destroy',
            getall: 'api.colleges.all',
            import: 'api.patient.import',
        },
    })
}
</script>
