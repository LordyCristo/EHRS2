<template>
    <Finance title="Cashier">
        <DataTable :columnsLarge="columnsLarge" :columnsSmall="columnsSmall" :apiLink="apiLink" />
    </Finance>
</template>
<script setup>
import Finance from "@/Pages/Finance.vue";
import DataTable from "@/Components/DataTable/DataTable.vue";
import NotifBanner from "@/Components/Generic/Modals/NotifBanner.vue";
</script>
<script>
export default{
    data: () => ({
        columnsSmall:[
            {
                data: 'infirmary_id',
                name: 'infirmary_id',
                title: 'Infirmary ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'services_count',
                name: 'services_count',
                title: 'Services Count',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'total_amount',
                name: 'total_amount',
                title: 'Amount',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2',
            },
        ],
        columnsLarge: [
            {
                data: 'or_no',
                name:'or_no',
                title: 'OR No.',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-center dt-border-sm text-center px-2'
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
                data: 'infirmary_id',
                name: 'infirmary_id',
                title: 'Infirmary ID',
                searchable: true,
                orderable: true,
                collapsable: false,
                className: 'dt-border-sm text-center px-2',
            },
            {
                data: 'paid_services_count',
                name: 'paid_services_count',
                title: 'Services Count',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm text-center px-2',
            },
            {
                data: 'total_amount',
                name: 'total_amount',
                title: 'Amount',
                searchable: true,
                orderable: true,
                collapsable: true,
                className: 'dt-border-sm px-2 text-center',
            },
        ],
        apiLink: {
            // create form
            create: 'finance.payment.create',
            // edit form
            edit: 'finance.payment.edit',
            //view form
            show: 'finance.payment.show',
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
