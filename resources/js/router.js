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
        path:'/finance/fee/edit/:id',
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
        path:'/finance/payment/edit/:id',
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
        path:'/clients/edit/:id',
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
        path:'/radiology/request/edit/:id',
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
        path:'/radiology/result/edit/:id',
        name: 'radiology.result.edit',
        component: () => import('@/Pages/Radiology/Result/EditRadiology.vue')
    },{
        path:'/dental',
        name: 'dental.record.index',
        component: () => import('@/Pages/Dentistry/DentalRecord/DentalRecordIndex.vue')
    },
    {
        path:'/dental/new',
        name: 'dental.record.create',
        component: () => import('@/Pages/Dentistry/DentalRecord/NewDentalRecord.vue')
    },
    {
        path:'/dental/edit/:id',
        name: 'dental.record.edit',
        component: () => import('@/Pages/Dentistry/DentalRecord/EditDentalRecord.vue')
    },
    {
        path:'/laboratory',
        name: 'laboratory.index',
        component: () => import('@/Pages/Laboratory/LaboratoryIndex.vue')
    },
    {
        path:'/laboratory/requests',
        name: 'laboratory.requests.index',
        component: () => import('@/Pages/Laboratory/Request/LaboratoryRequestIndex.vue')
    },
    {
        path:'/laboratory/requests/new',
        name: 'laboratory.requests.create',
        component: () => import('@/Pages/Laboratory/Request/NewLaboratoryRequest.vue')
    },
    {
        path:'/laboratory/requests/edit/:id',
        name: 'laboratory.requests.edit',
        component: () => import('@/Pages/Laboratory/Request/EditLaboratoryRequest.vue')
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
        path:'/laboratory/hematology/edit/:id',
        name: 'laboratory.hematology.edit',
        component: () => import('@/Pages/Laboratory/Hematology/EditHematology.vue')
    },
    {
        path:'/laboratory/hematology/show/:id',
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
        path:'/laboratory/fecalysis/edit/:id',
        name: 'laboratory.fecalysis.edit',
        component: () => import('@/Pages/Laboratory/Fecalysis/EditFecalysis.vue')
    },
    {
        path:'/laboratory/fecalysis/show/:id',
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
        path:'/laboratory/urinalysis/edit/:id',
        name: 'laboratory.urinalysis.edit',
        component: () => import('@/Pages/Laboratory/Urinalysis/EditUrinalysis.vue')
    },
    {
        path:'/laboratory/urinalysis/show/:id',
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
        path:'/more/college/edit/:id',
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
        path:'/more/department/edit/:id',
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
        path:'/more/program/edit/:id',
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
        path:'/more/service/edit/:id',
        name: 'more.service.edit',
        component: () => import('@/Pages/MorePages/Services/EditService.vue')
    },
    {
        path:'/records',
        name: 'records',
        component: () => import('@/Pages/Records/RecordIndex.vue')
    },
    {
        path:'/records/show/:id',
        name: 'records',
        component: () => import('@/Pages/Records/ViewRecord.vue')
    },
    {
        path:'/records/medical-certificate/:id',
        name: 'records.medcert',
        component: () => import('@/Pages/Records/MedicalCertificate.vue')
    },
    {
        path:'/records/printable/:id',
        name: 'records.medcert.printable',
        component: () => import('@/Pages/Records/MedicalCertificatePrintable.vue')
    },
    {
        path:'/physicalexam',
        name: 'physicalexam.index',
        component: () => import('@/Pages/PhysicalExam/PhysicalExamIndex.vue')
    },
    {
        path:'/physicalexam/new',
        name: 'physicalexam.create',
        component: () => import('@/Pages/PhysicalExam/NewPhysicalExam.vue')
    },
    {
        path:'/physicalexam/edit/:id',
        name: 'physicalexam.edit',
        component: () => import('@/Pages/PhysicalExam/EditPhysicalExam.vue')
    },

]

const router = createRouter({
    history,
    routes
})

export { router }
