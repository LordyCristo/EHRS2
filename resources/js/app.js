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

const routes = [
    { path:'/more/college', name: 'more.college.index', component: CollegeIndex },
    { path:'/more/college/new', name: 'more.college.create', component: NewCollege },
    { path:'/more/college/edit/', name: 'more.college.edit', component: EditCollege },
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
