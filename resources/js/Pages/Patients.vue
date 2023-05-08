<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolbarPatient from '@/Pages/Patient/ToolbarPatient.vue';
</script >
<script>
export default {
    computed: {
        isPatientsPage() {
            return window.location.pathname === '/patients';
        }
    },
    methods: {
        deleteItem(id) {
            console.log(id);
        }
    },
    data: () => ({
        items: [
            {
                title: 'Patients',
                disabled: true,
                href: 'patients',
            },
            {
                title: 'New Patient',
                disabled: false,
                href: 'newPatient',
            },
            {
                title: 'Edit Patient',
                disabled: false,
                href: 'editPatient',
            },
        ],
    }),
}
</script>
<template>
    <AppLayout title="Patients">
        <template #toolbar>
            <ToolbarPatient></ToolbarPatient>
        </template>
        <slot></slot>
    </AppLayout>
</template>