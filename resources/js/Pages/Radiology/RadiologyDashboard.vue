<script setup>
import Radiology from '@/Pages/Radiology.vue';
import DataTable from '@/Components/Generic/Layout/DataTable.vue';

import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import { markRaw } from 'vue';
</script>
<script>
export default {
    data: () => ({
        apiLink: {
            index: 'api.programs',
            create: 'api.program.create',
            store: 'api.program.store',
            edit: 'api.program.edit',
            update: 'api.program.update',
            destroy: 'api.program.destroy',  
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                title: 'ID',
                searchable: true,
                className: 'dt-center dt-border-sm px-2',
            },
            {
                data: 'name',
                name: 'name',
                title: 'Name',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'abbr',
                name: 'abbr',
                title: 'Abbr',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'major',
                name: 'major',
                title: 'Major',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: 'department_id',
                name: 'department_id',
                title: 'Dept',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            {
                data: null,
                icon: [markRaw(DeleteIcon), markRaw(EditIcon)],
                name: 'actions',
                title: 'Actions',
                searchable: false,
                className: 'dt-center flex justify-center',
            },
        ],
    }),
};
</script>
<template>
    <Radiology title="New Patient">
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="row">                            
                        <data-table :columns="columns" :apiLink="apiLink"></data-table>
                    </div>
                </div>
            </div>
        </div>
    </Radiology>
</template>

