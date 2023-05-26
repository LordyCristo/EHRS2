import { createRouter, createWebHistory } from 'vue-router'
import ClientIndex from "@/Pages/Client/ClientIndex.vue";
import NewClient from "@/Pages/Client/NewClient.vue";
import EditClient from "@/Pages/Client/EditClient.vue";
import HematologyIndex from "@/Pages/Laboratory/Hematology/HematologyIndex.vue";
import NewHematology from "@/Pages/Laboratory/Hematology/NewHematology.vue";
import EditHematology from "@/Pages/Laboratory/Hematology/EditHematology.vue";
import MorePageIndex from "@/Pages/MorePages/MorePageIndex.vue";
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
import LaboratoryIndex from "@/Pages/Laboratory/LaboratoryIndex.vue";
import Dashboard from "@/Pages/Dashboard.vue";
import Finance from "@/Pages/Finance.vue";
import FeeIndex from "@/Pages/Finance/Fees/FeeIndex.vue";
import NewFee from "@/Pages/Finance/Fees/NewFee.vue";
import EditFee from "@/Pages/Finance/Fees/EditFee.vue";

const history = createWebHistory()
const routes = [
    { path:'/dashboard', name: 'dashboard.index', component: Dashboard },
    { path:'/finance', name: 'finance.index', component: Finance },
    { path:'/finance/fee', name: 'finance.fee.index', component: FeeIndex },
    { path:'/finance/fee/new', name: 'finance.fee.create', component: NewFee },
    { path:'/finance/fee/edit', name: 'finance.fee.edit', component: EditFee },
    { path:'/clients', name: 'client.index', component: ClientIndex },
    { path:'/clients/new', name: 'client.create', component: NewClient },
    { path:'/clients/edit/', name: 'client.edit', component: EditClient },
    { path:'/laboratory', name: 'laboratory.index', component: LaboratoryIndex },
    { path:'/laboratory/hematology', name: 'laboratory.hematology.index', component: HematologyIndex },
    { path:'/laboratory/hematology/new', name: 'laboratory.hematology.create', component: NewHematology },
    { path:'/laboratory/hematology/edit', name: 'laboratory.hematology.edit', component: EditHematology },
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
const router = createRouter({
    history,
    routes
})

export { router }
