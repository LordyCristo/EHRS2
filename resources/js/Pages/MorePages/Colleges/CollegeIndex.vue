<template>
    <MorePages title="Colleges">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" />
        <NotifBanner :message="notifMessage" :type="notifType" />
    </MorePages>
</template>
<script setup>
import MorePages from '@/Pages/MorePages.vue';
import DataTable from "@/Components/DataTable/DataTable.vue";
import NotifBanner from "@/Components/Generic/Modals/NotifBanner.vue";
</script>
<script>
export default{
    props: {
        notifMessage: String,
        notifType: String,
    },
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
            table: 'api.college.table',
            create: 'more.college.create',
            store: 'api.college.store',
            edit: 'more.college.edit',
            update: 'api.patient.update',
            destroy: 'api.college.destroy',
            getall: 'api.college.all',
            import: 'api.college.import',
        },
    })
}
</script>
