<script>
import MoreIcon from "@/Components/Icons/MoreIcon.vue";
import ClientRecordsIcon from "@/Components/Icons/PatientRecordsIcon.vue";
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
import Sidebar from "@/Components/Generic/Layout/Sidebar.vue";
import { Head } from '@inertiajs/vue3';
import {markRaw} from "vue";
import FinanceIcon from "@/Components/Icons/FinanceIcon.vue";


export default {
    components: {
        Head,
        Sidebar,
        MoreIcon,
        PatientRecordsIcon: ClientRecordsIcon,
        HomeIcon,
        MedicalRecordIcon,
        RadiologyIcon,
        LaboratoryIcon,
        DentalIcon,
        WardIcon,
        MaternityIcon,
        SurgeryIcon,
        SettingsIcon,
        LogoutIcon,
    },
    props: {
        items: {
            type: Array,
            required: false,
        },
        title: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            notifications: [],
            showingNavigationDropdown: false,
            sidebarItems: [
                {
                    title: 'Dashboard',
                    link: 'dashboard',
                    tabName: '/dashboard',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(HomeIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Clients',
                    link: 'client.index',
                    tabName: '/clients',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(ClientRecordsIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Records',
                    link: 'records',
                    tabName: '/records',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(MedicalRecordIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Radiology',
                    link: 'radiology',
                    tabName: '/radiology',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(RadiologyIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Dental',
                    link: 'dental',
                    tabName: '/dental',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(DentalIcon),
                    form: false,
                },
                {
                    title: 'Laboratories',
                    link: 'laboratory.index',
                    tabName: '/laboratory',
                    subLinks: [{
                        title: 'More',
                        content: [
                            // {
                            //     name: 'Urinalysis',
                            //     link: 'more.college.index',
                            //     linkName: 'college',
                            // },
                            // {
                            //     name: 'Fecalysis',
                            //     link: 'more.department.index',
                            //     linkName: 'department',
                            // },
                            {
                                name: 'Hematology',
                                link: 'laboratory.hematology.index',
                                linkName: 'hematology',
                            },
                        ],
                        isOpen: false
                    }],
                    isOpen: false,
                    icon: markRaw(LaboratoryIcon),
                    form: true,
                    method: null,
                },
                {
                    title: 'Finance',
                    link: 'finance.index',
                    tabName: '/finance',
                    subLinks: [{
                        title: 'More',
                        content: [
                            {
                                name: 'Fees',
                                link: 'finance.fee.index',
                                linkName: 'fee',
                            },
                            {
                                name: 'Payments',
                                link: 'finance.payment.index',
                                linkName: 'payment',
                            },
                        ],
                        isOpen: false
                    }],
                    isOpen: false,
                    icon: markRaw(FinanceIcon),
                    form: true,
                    method: null,
                },
                {
                    title: 'Surgery',
                    link: 'surgery',
                    tabName: '/surgery',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(SurgeryIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Maternity',
                    link: 'maternity',
                    tabName: '/maternity',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(MaternityIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Ward',
                    link: 'ward',
                    tabName: '/ward',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(WardIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'More',
                    link: 'more.pages',
                    tabName: '/more',
                    subLinks: [{
                        title: 'More',
                        content: [
                            {
                                name: 'Colleges',
                                link: 'more.college.index',
                                linkName: 'college',
                            },
                            {
                                name: 'Departments',
                                link: 'more.department.index',
                                linkName: 'department',
                            },
                            {
                                name: 'Programs',
                                link: 'more.program.index',
                                linkName: 'program',
                            },
                            {
                                name: 'Services',
                                link: 'more.service.index',
                                linkName: 'service',
                            },
                        ],
                        isOpen: false
                    }],
                    isOpen: false,
                    icon: markRaw(MoreIcon),
                    form: true,
                    method: null,
                },
                {
                    title: 'Settings',
                    link: 'profile.show',
                    tabName: '/user/profile',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(SettingsIcon),
                    form: false,
                    method: null,
                },
                {
                    title: 'Logout',
                    link: 'logout',
                    tabName: '/logout',
                    subLinks: null,
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
    <Head :title="title" ><title>{{ title }}</title></Head>
    <Sidebar :items="sidebarItems">
        <!-- The body of the sidebar -->
        <template #body>
            <!-- Page Toolbar Section -->
            <header class="flex flex-row shadow-md bg-white">
                <slot name="toolbar" />
            </header>
            <!-- Page Content -->
            <main class="flex flex-row flex-grow overflow-hidden sm:p-5 p-1">
                <slot />
            </main>
        </template>
    </Sidebar>
</template>
