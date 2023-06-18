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
import ERIcon from "@/Components/Icons/ERIcon.vue";
import UserApproveIcon from "@/Components/Icons/UserApproveIcon.vue";


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
                    show: true,
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
                    show: this.$page.props.auth.user.role === 1 || this.$page.props.auth.user.role === 7,
                    title: 'In/Out Patient',
                    link: 'client.index',
                    tabName: '/clients',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(ClientRecordsIcon),
                    form: false,
                    method: null,
                },
                // {
                //     show: this.$page.props.auth.user.role === 1,
                //     title: 'Outpatient',
                //     link: 'surgery',
                //     tabName: '/surgery',
                //     subLinks: null,
                //     isOpen: false,
                //     icon: markRaw(SurgeryIcon),
                //     form: false,
                //     method: null,
                // },
                {
                    show: this.$page.props.auth.user.role === 1,
                    title: 'ER Section',
                    link: 'er.index',
                    tabName: '/emergency',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(ERIcon),
                    form: false,
                    method: null,
                },
                {
                    show: this.$page.props.auth.user.role === 1,
                    title: 'Medical Records',
                    link: 'records',
                    tabName: '/records',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(MedicalRecordIcon),
                    form: false,
                    method: null,
                },
                {
                    show: this.$page.props.auth.user.role === 1 || this.$page.props.auth.user.role === 4,
                    title: 'Radiology',
                    link: 'radiology.index',
                    tabName: '/radiology',
                    subLinks: [{
                        title: 'More',
                        content: [
                            {
                                name: 'X-ray Request ',
                                link: 'radiology.request.index',
                                linkName: 'request',
                            },
                            {
                                name: 'X-ray Result',
                                link: 'radiology.result.index',
                                linkName: 'result',
                            },
                        ],
                        isOpen: false
                    }],
                    isOpen: false,
                    icon: markRaw(RadiologyIcon),
                    form: true,
                    method: null,
                },
                {
                    show: this.$page.props.auth.user.role === 1 || this.$page.props.auth.user.role === 5,
                    title: 'Dental',
                    link: 'dental.index',
                    tabName: '/dental',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(DentalIcon),
                    form: false,
                },
                {
                    show: this.$page.props.auth.user.role === 2 || this.$page.props.auth.user.role === 1,
                    title: 'Laboratories',
                    link: 'laboratory.index',
                    tabName: '/laboratory',
                    subLinks: [{
                        title: 'More',
                        content: [
                            {
                                name: 'Urinalysis',
                                link: 'laboratory.urinalysis.index',
                                linkName: 'urinalysis',
                            },
                            {
                                name: 'Fecalysis',
                                link: 'laboratory.fecalysis.index',
                                linkName: 'fecalysis',
                            },
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
                    show: this.$page.props.auth.user.role === 3 || this.$page.props.auth.user.role === 1,
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
                // {
                //     show: this.$page.props.auth.user.role === 1,
                //     title: 'Ward',
                //     link: 'ward',
                //     tabName: '/ward',
                //     subLinks: null,
                //     isOpen: false,
                //     icon: markRaw(WardIcon),
                //     form: false,
                //     method: null,
                // },
                {
                    show: this.$page.props.auth.user.role === 1,
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
                    show: this.$page.props.auth.user.role === 1,
                    title: 'Confirm Users',
                    link: 'user.approve',
                    tabName: '/approve',
                    subLinks: null,
                    isOpen: false,
                    icon: markRaw(UserApproveIcon),
                    form: false,
                    method: null,
                },
                {
                    show: true,
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
                    show: true,
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
