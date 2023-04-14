<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolbarPatient from '@/Pages/Patient/ToolbarPatient.vue';
import Breadcrumbs from '@/Components/Generic/Layout/Breadcrumbs.vue';
</script>

<script>
export default {
    components: {
        AppLayout,
        ToolbarPatient,
        Breadcrumbs,
    },
    computed: {
        isPatientsPage() {
            return window.location.pathname === '/patients';
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
    })
}
</script>

<template>
    <AppLayout title="Patients">
        <template #toolbar>
            <ToolbarPatient></ToolbarPatient>
        </template>
        <template #breadcrumbs v-if="!isPatientsPage">
            <Breadcrumbs :items="items"></Breadcrumbs>
        </template>
        <div class="m-2">
            <slot></slot>
        </div>
    </AppLayout>
</template>
