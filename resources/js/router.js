import { createRouter, createWebHistory } from 'vue-router'
const history = createWebHistory()

const routes = [
    {
        path:'/',
        name: 'dashboard',
        component: () => import('@/Pages/Dashboard.vue')
    },
    {
        path:'/login',
        name: 'login',
        component: () => import('@/Pages/Auth/Login.vue')
    },
    {
        path:'/register',
        name: 'register',
        component: () => import('@/Pages/Auth/Register.vue')
    },
    {
        path:'/public/client/new',
        name: 'public.client.create',
        component: () => import('@/Pages/Client/PublicNewClient.vue')
    },
    {
        path:'/dashboard',
        name: 'dashboard.index',
        component: () => import('@/Pages/Dashboard.vue')
    },
    {
        path:'/finance',
        name: 'finance.index',
        component: () => import('@/Pages/Finance.vue')
    },
    {
        path:'/finance/fee',
        name: 'finance.fee.index',
        component: () => import('@/Pages/Finance/Fees/FeeIndex.vue')
    },
    {
        path:'/finance/fee/new',
        name: 'finance.fee.create',
        component: () => import('@/Pages/Finance/Fees/NewFee.vue')
    },
    {
        path:'/finance/fee/edit',
        name: 'finance.fee.edit',
        component: () => import('@/Pages/Finance/Fees/EditFee.vue')
    },
    {
        path:'/finance/payment',
        name: 'finance.payment.index',
        component: () => import('@/Pages/Finance/Payment/PaymentIndex.vue')
    },
    {
        path:'/finance/payment/new',
        name: 'finance.payment.create',
        component: () => import('@/Pages/Finance/Payment/NewPayment.vue')
    },
    {
        path:'/finance/payment/edit',
        name: 'finance.payment.edit',
        component: () => import('@/Pages/Finance/Payment/EditPayment.vue')
    },
    {
        path:'/clients',
        name: 'client.index',
        component: () => import('@/Pages/Client/ClientIndex.vue')
    },
    {
        path:'/clients/new',
        name: 'client.create',
        component: () => import('@/Pages/Client/NewClient.vue')
    },
    {
        path:'/clients/edit/',
        name: 'client.edit',
        component: () => import('@/Pages/Client/EditClient.vue')
    },
    {
        path:'/radiology/request',
        name: 'radiology.request.index',
        component: () => import('@/Pages/Radiology/Request/RadiologyRequestIndex.vue')
    },
    {
        path:'/radiology/request/new',
        name: 'radiology.request.create',
        component: () => import('@/Pages/Radiology/Request/NewRadiologyRequest.vue')
    },
    {
        path:'/radiology/request/edit',
        name: 'radiology.request.edit',
        component: () => import('@/Pages/Radiology/Request/EditRadiologyRequest.vue')
    },
    {
        path:'/radiology/result',
        name: 'radiology.result.index',
        component: () => import('@/Pages/Radiology/Result/RadiologyIndex.vue')
    },
    {
        path:'/radiology/result/new',
        name: 'radiology.result.create',
        component: () => import('@/Pages/Radiology/Result/NewRadiology.vue')
    },
    {
        path:'/radiology/result/edit',
        name: 'radiology.result.edit',
        component: () => import('@/Pages/Radiology/Result/EditRadiology.vue')
    },
    {
        path:'/laboratory',
        name: 'laboratory.index',
        component: () => import('@/Pages/Laboratory/LaboratoryIndex.vue')
    },
    {
        path:'/laboratory/hematology',
        name: 'laboratory.hematology.index',
        component: () => import('@/Pages/Laboratory/Hematology/HematologyIndex.vue')
    },
    {
        path:'/laboratory/hematology/new',
        name: 'laboratory.hematology.create',
        component: () => import('@/Pages/Laboratory/Hematology/NewHematology.vue')
    },
    {
        path:'/laboratory/hematology/edit',
        name: 'laboratory.hematology.edit',
        component: () => import('@/Pages/Laboratory/Hematology/EditHematology.vue')
    },
    {
        path:'/laboratory/hematology/show',
        name: 'laboratory.hematology.show',
        component: () => import('@/Pages/Laboratory/Hematology/ViewHematology.vue')
    },
    {
        path:'/laboratory/fecalysis',
        name: 'laboratory.fecalysis.index',
        component: () => import('@/Pages/Laboratory/Fecalysis/FecalysisIndex.vue')
    },
    {
        path:'/laboratory/fecalysis/new',
        name: 'laboratory.fecalysis.create',
        component: () => import('@/Pages/Laboratory/Fecalysis/NewFecalysis.vue')
    },
    {
        path:'/laboratory/fecalysis/edit',
        name: 'laboratory.fecalysis.edit',
        component: () => import('@/Pages/Laboratory/Fecalysis/EditFecalysis.vue')
    },
    {
        path:'/laboratory/fecalysis/show',
        name: 'laboratory.fecalysis.show',
        component: () => import('@/Pages/Laboratory/Fecalysis/ViewFecalysis.vue')
    },
    {
        path:'/laboratory/urinalysis',
        name: 'laboratory.urinalysis.index',
        component: () => import('@/Pages/Laboratory/Urinalysis/UrinalysisIndex.vue')
    },
    {
        path:'/laboratory/urinalysis/new',
        name: 'laboratory.urinalysis.create',
        component: () => import('@/Pages/Laboratory/Urinalysis/NewUrinalysis.vue')
    },
    {
        path:'/laboratory/urinalysis/edit',
        name: 'laboratory.urinalysis.edit',
        component: () => import('@/Pages/Laboratory/Urinalysis/EditUrinalysis.vue')
    },
    {
        path:'/laboratory/urinalysis/show',
        name: 'laboratory.urinalysis.show',
        component: () => import('@/Pages/Laboratory/Urinalysis/ViewUrinalysis.vue')
    },
    {
        path:'/more/',
        name: 'more.pages',
        component: () => import('@/Pages/MorePages/MorePageIndex.vue')
    },
    {
        path:'/more/college',
        name: 'more.college.index',
        component: () => import('@/Pages/MorePages/Colleges/CollegeIndex.vue')
    },
    {
        path:'/more/college/new',
        name: 'more.college.create',
        component: () => import('@/Pages/MorePages/Colleges/NewCollege.vue')
    },
    {
        path:'/more/college/edit/',
        name: 'more.college.edit',
        component: () => import('@/Pages/MorePages/Colleges/EditCollege.vue')
    },
    {
        path:'/more/department',
        name: 'more.department.index',
        component: () => import('@/Pages/MorePages/Departments/DepartmentIndex.vue')
    },
    {
        path:'/more/department/new',
        name: 'more.department.create',
        component: () => import('@/Pages/MorePages/Departments/NewDepartment.vue')
    },
    {
        path:'/more/department/edit/',
        name: 'more.department.edit',
        component: () => import('@/Pages/MorePages/Departments/EditDepartment.vue')
    },
    {
        path:'/more/program',
        name: 'more.program.index',
        component: () => import('@/Pages/MorePages/Programs/ProgramIndex.vue')
    },
    {
        path:'/more/program/new',
        name: 'more.program.create',
        component: () => import('@/Pages/MorePages/Programs/NewProgram.vue')
    },
    {
        path:'/more/program/edit/',
        name: 'more.program.edit',
        component: () => import('@/Pages/MorePages/Programs/EditProgram.vue')
    },
    {
        path:'/more/service',
        name: 'more.service.index',
        component: () => import('@/Pages/MorePages/Services/ServiceIndex.vue')
    },
    {
        path:'/more/service/new',
        name: 'more.service.create',
        component: () => import('@/Pages/MorePages/Services/NewService.vue')
    },
    {
        path:'/more/service/edit/',
        name: 'more.service.edit',
        component: () => import('@/Pages/MorePages/Services/EditService.vue')
    },
]

const router = createRouter({
    history,
    routes
})

export { router }
