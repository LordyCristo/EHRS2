<template>
    <Finance title="Finance">
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
                data: 'client_id',
                name: 'client_id',
                title: 'Client',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'service_id',
                name: 'service_id',
                title: 'Service',
                searchable: true,
                orderable: true,
                collapsable: true,
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
                title: 'OR No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm px-2'
            },
            {
                data: 'payor_name',
                name: 'payor_name',
                title: 'Payor',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'client_id',
                name: 'client_id',
                title: 'Client',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'service_id',
                name: 'service_id',
                title: 'Service',
                searchable: true,
                orderable: true,
                collapsable: true,
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
            {
                data: 'collector_id',
                name: 'collector_id',
                title: 'Collector ID',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        apiLink: {
            // create form
            create: 'finance.payment.create',
            // edit form
            edit: 'finance.payment.edit',
            // return all data
            index: 'api.payment.index',
            // return data compatible for datatable requests
            table: 'api.payment.table',
            // store data from create form
            store: 'api.payment.store',
            // update data from edit form
            update: 'api.payment.update',
            // delete a specific data
            destroy: 'api.payment.destroy',
            // import data from excel
            import: 'api.payment.import',
        },
    })
}
</script>
