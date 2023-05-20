import { createRouter, createWebHistory } from 'vue-router'
import CollegeIndex from "@/Pages/MorePages/Colleges/CollegeIndex.vue";

const history = createWebHistory()
const routes = [
    {
        path: '/more/college',
        name: 'more.college',
        component: CollegeIndex,
        meta: {
            layout: 'default'
        }
    },
]
const router = createRouter({
    linkActiveClass: 'active',
    history,
    routes
})

export { router }
