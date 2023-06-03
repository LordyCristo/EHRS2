<template>
    <Finance title="Fees">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" />
        <NotifBanner :message="notifMessage" :type="notifType" />
    </Finance>
</template>
<script setup>
import Finance from "@/Pages/Finance.vue";
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
                data: 'client_type',
                name: 'client_type',
                title: 'Client Type',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'amount',
                name: 'amount',
                title: 'Amount',
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
                orderable: false,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'service_id',
                name: 'service_id',
                title: 'Service ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'service',
                name: 'service',
                title: 'Service',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'client_type',
                name: 'client_type',
                title: 'Client Type',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'amount',
                name: 'amount',
                title: 'Amount',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        apiLink: {
            // create form
            create: 'finance.fee.create',
            // edit form
            edit: 'finance.fee.edit',
            // return all data
            index: 'api.fee.index',
            // return data compatible for datatable requests
            table: 'api.fee.table',
            // store data from create form
            store: 'api.fee.store',
            // update data from edit form
            update: 'api.fee.update',
            // delete a specific data
            destroy: 'api.fee.destroy',
            // import data from excel
            import: 'api.fee.import',
        },
    })
}
</script>
