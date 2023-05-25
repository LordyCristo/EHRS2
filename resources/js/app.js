import './bootstrap';
import '../css/app.css';
import '../css/jquery.dataTables.min.css';
import '../css/datatables.net.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { router } from './router';
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
