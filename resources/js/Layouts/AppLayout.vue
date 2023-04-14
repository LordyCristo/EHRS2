<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
import PatientRecordsIcon from "@/Components/Icons/PatientRecordsIcon.vue";
import HomeIcon from "@/Components/Icons/HomeIcon.vue";
import MedicalRecordIcon from "@/Components/Icons/MedicalRecordIcon.vue";
import RadiologyIcon from "@/Components/Icons/RadiologyIcon.vue";
import LaboratoryIcon from "@/Components/Icons/LaboratoryIcon.vue";
import DentalIcon from "@/Components/Icons/DentalIcon.vue";
import WardIcon from "@/Components/Icons/WardIcon.vue";
import MaternityIcon from "@/Components/Icons/MaternityIcon.vue";
import SurgeryIcon from "@/Components/Icons/SurgeryIcon.vue";
import SettingsIcon from "@/Components/Icons/SettingsIcon.vue";
import LogoutIcon from "@/Components/Icons/LogoutIcon.vue";
import { markRaw } from 'vue';

defineProps({
    items: {
        type: Array,
        required: false,
    },
    title: {
        type: String,
        required: true,
    },
});

</script>
<script>
export default {
    data() {
        return {
            showingNavigationDropdown: false,
            sidebarItems: [
                {
                    title: 'Dashboard',
                    link: 'dashboard',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(HomeIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Patients',
                    link: 'patients',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(PatientRecordsIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Records',
                    link: 'records',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(MedicalRecordIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Radiology',
                    link: 'radiology',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(RadiologyIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Dental',
                    link: 'dental',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(DentalIcon),
                    form: false,
                },
                {
                    title: 'Laboratories',
                    link: 'laboratory',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(LaboratoryIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Surgery',
                    link: 'surgery',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(SurgeryIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Maternity',
                    link: 'maternity',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(MaternityIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Ward',
                    link: 'ward',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(WardIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Settings',
                    link: 'profile.show',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(SettingsIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Logout',
                    link: 'logout',
                    hasSubLinks: false,
                    isOpen: false,
                    icon: markRaw(LogoutIcon),
                    form: true,
                    method: 'POST',
                },
            ],
        };
    },
};
</script>
<template>
    <Head :title="title" />
    <Sidebar :items="sidebarItems">
        <!-- The body of the sidebar -->
        <template #body>
            <!-- Page Toolbar Section -->
            <header class="flex flex-row shadow-md bg-white">
                <slot name="toolbar" />
            </header>
            <template v-if="$slots.breadcrumbs">
                <slot name="breadcrumbs" />
            </template>

            <!-- Page Content -->
            <slot />
        </template>
    </Sidebar>
</template>
