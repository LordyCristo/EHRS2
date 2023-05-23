import './bootstrap';
import '../css/app.css';
import '../css/jquery.dataTables.min.css';
import '../css/datatables.net.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createRouter, createWebHistory } from 'vue-router';
import CollegeIndex from "@/Pages/MorePages/Colleges/CollegeIndex.vue";
import NewCollege from "@/Pages/MorePages/Colleges/NewCollege.vue";
import EditCollege from "@/Pages/MorePages/Colleges/EditCollege.vue";
import DepartmentIndex from "@/Pages/MorePages/Departments/DepartmentIndex.vue";
import NewDepartment from "@/Pages/MorePages/Departments/NewDepartment.vue";
import EditDepartment from "@/Pages/MorePages/Departments/EditDepartment.vue";
import ProgramIndex from "@/Pages/MorePages/Programs/ProgramIndex.vue";
import NewProgram from "@/Pages/MorePages/Programs/NewProgram.vue";
import EditProgram from "@/Pages/MorePages/Programs/EditProgram.vue";
import ServiceIndex from "@/Pages/MorePages/Services/ServiceIndex.vue";
import NewService from "@/Pages/MorePages/Services/NewService.vue";
import EditService from "@/Pages/MorePages/Services/EditService.vue";
import MorePageIndex from "@/Pages/MorePages/MorePageIndex.vue";
import ClientIndex from "@/Pages/Client/ClientIndex.vue";
import NewClient from "@/Pages/Client/NewClient.vue";
import EditClient from "@/Pages/Client/EditClient.vue";

const routes = [
    { path:'/clients', name: 'client.index', component: ClientIndex },
    { path:'/clients/new', name: 'client.create', component: NewClient },
    { path:'/clients/edit/', name: 'client.edit', component: EditClient },
    { path:'/more/', name: 'more.pages', component: MorePageIndex },
    { path:'/more/college', name: 'more.college.index', component: CollegeIndex },
    { path:'/more/college/new', name: 'more.college.create', component: NewCollege },
    { path:'/more/college/edit/', name: 'more.college.edit', component: EditCollege },
    { path:'/more/department', name: 'more.department.index', component: DepartmentIndex },
    { path:'/more/department/new', name: 'more.department.create', component: NewDepartment },
    { path:'/more/department/edit/', name: 'more.department.edit', component: EditDepartment },
    { path:'/more/program', name: 'more.program.index', component: ProgramIndex },
    { path:'/more/program/new', name: 'more.program.create', component: NewProgram },
    { path:'/more/program/edit/', name: 'more.program.edit', component: EditProgram },
    { path:'/more/service', name: 'more.service.index', component: ServiceIndex },
    { path:'/more/service/new', name: 'more.service.create', component: NewService },
    { path:'/more/service/edit/', name: 'more.service.edit', component: EditService },
]

const router =  createRouter({
    history: createWebHistory(),
    routes
})
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'EHRS';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(router)
            .mount(el);
    },
    progress: {
        color: '#06430D',
    },
});
