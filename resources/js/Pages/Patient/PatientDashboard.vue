<script setup>
import Patients from '@/Pages/Patients.vue';
import DataTable from '@/Components/Generic/Layout/DataTable.vue';

import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import { markRaw } from 'vue';

</script>
<script>
export default {
    data: () => ({
        apiLink: {
            index: 'api.patients',
            create: 'api.patient.create',
            store: 'api.patient.store',
            edit: 'api.patient.edit',
            update: 'api.patient.update',
            destroy: 'api.patient.destroy',  
        },
        columns: [
            { 
                data: 'id', 
                name:'id', 
                title: 'ID', 
                searchable: true, 
                className: 'dt-center dt-border-sm px-2' 
            },
            { 
                data: 'first_name', 
                name: 'first_name',
                title: 'First Name',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'middle_name',
                name: 'middle_name',
                title: 'Middle',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'last_name', 
                name: 'last_name',
                title: 'Surname',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'suffix', 
                name: 'suffix',
                title: 'Suffix',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'age', 
                name: 'age',
                title: 'Age',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'sex',
                name: 'sex',
                title: 'Sex', 
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'civil_status', 
                name: 'civil_status',
                title: 'Civil Status',
                searchable: true,
                className: 'dt-border-sm px-2',
            },
            { 
                data: 'client_type_id', 
                name: 'client_type_id',
                title: 'Type',
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
            }
        ],

    }),
}
</script>

<template>
    <Patients title="New Patient">
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="row">
                        <data-table :columns="columns" :apiLink="apiLink"></data-table>
                    </div>
                </div>
            </div>
        </div>
    </Patients>
</template>