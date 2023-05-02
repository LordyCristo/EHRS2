<script>
import Patients from '@/Pages/Patients.vue';
import DataTable from 'datatables.net-vue3';
import DataTableLib from 'datatables.net-bs5';
import Button from 'datatables.net-buttons-bs5';
import ButtonHtml5 from 'datatables.net-buttons/js/buttons.html5';
import print from 'datatables.net-buttons/js/buttons.print';
import pdfmake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import 'datatables.net-responsive-bs5';
import 'datatables.net-select-bs5';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import { Link, router } from '@inertiajs/vue3';

pdfmake.vfs = pdfFonts.pdfMake.vfs;

import JsZip from 'jszip';
window.JSZip = JsZip;
DataTable.use(DataTableLib);
DataTable.use(pdfmake);
DataTable.use(ButtonHtml5);

const gotoEditPage = (id) => {
    router.get({ name: 'editPatient', params: { id: id } });
};

const deleteItem = (id) => {
    console.log(id);
};

export default {
    components: {
        Patients,
        DataTable,
    },
    computed: {
        isPatientsPage() {
            return window.location.pathname === '/patients';
        }
    },
    methods: {
        deleteItem(id) {
            console.log(id);
        }
    },
    data: () => ({
        items: [
            {
                title: 'Patients',
                disabled: true,
                href: 'patients',
            },
            {
                title: 'New Patient',
                disabled: false,
                href: 'newPatient',
            },
            {
                title: 'Edit Patient',
                disabled: false,
                href: 'editPatient',
            },
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'first_name', title: 'First Name' },
            { data: 'middle_name', title: 'Middle' },
            { data: 'last_name', title: 'Surname' },
            { data: 'suffix', title: 'Suffix' },
            { data: 'age', title: 'Age' },
            { data: 'sex', title: 'Sex' },
            { data: 'civil_status', title: 'Civil Status' },
            { data: 'client_type_id', title: 'Type' },
            {
                data: null,
                title: 'Action',
                render: function (data, type, row) {
                    return `<div class="inline-flex">
                            <button class="text-yellow-300 hover:bg-yellow-600 font-bold p-1 rounded-l">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 250 250" fill="currentColor" stroke="currentColor">
                                    <path d="M38.1,211.5L38.1,211.5c15.5,15.5,40.6,15.5,56,0L232.3,73.3c15.5-15.5,15.5-40.6,0-56l0,0c-15.5-15.5-40.6-15.5-56,0
                                            L38.1,155.5C22.6,171.1,22.6,196.1,38.1,211.5z" />
                                    <polygon points="85.6,218.8 7.4,242.5 28.4,169.8 36.7,176.8 78,212.3 " />
                                    <rect x="106.6" y="24.5" transform="matrix(0.7071 0.7071 -0.7071 0.7071 121.8673 -59.3326)" fill="currentColor"
                                        width="51.9" height="186" />
                                </svg>
                            </button>
                            <button class="text-red-300 hover:bg-red-600 font-bold p-1 rounded-r">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 250" class="fill-current w-4 h-4" fill="currentColor" stroke="currentColor">
                                <rect x="51.6" y="72.4" width="146.9" height="157" />
                                <polygon fill="#FFFFFF" points="140.1,151 167,178 152.2,192.8 125.3,165.9 98,193.2 83.1,178.4 110.4,151 82.7,123.3 97.5,108.5
                                        125.3,136.2 152.6,108.9 167.5,123.7 " />
                                <polygon points="208.2,31.1 208.2,52.2 41.6,52.2 41.6,31.1 99.5,31.1 104.8,21.8 145,21.8 150.4,31.1 " />
                            </svg>
                            </button>
                            </div>`;
                },
                orderable: false,
                searchable: false,
            }
        ],
        options: {
            responsive: false,
            select: true,
            autoWidth: true,
            dom: 'Bfrltip',
            serverSide: true,
            processing: true,
            stateSave: true,
            scrollX: true,
            scrollY: '70vh',
            deferRender: true,
            // paging: true,
            // destroy: true,
            buttons: [
                {
                    title: 'Patients Report',
                    extend: 'excelHtml5',
                    text: '<span class="bg-green-500 hover:bg-blue-700 text-white py-1 px-2">Excel</span>',
                    class: '',
                },
                {
                    title: 'Patients Report',
                    extend: 'pdfHtml5',
                    text: '<span class="bg-red-500 hover:bg-blue-700 text-white py-1 px-2">PDF</span>',
                    class: 'btn btn-danger btn-sm',
                },
                {
                    title: 'Patients Report',
                    extend: 'copy',
                    text: '<span class="bg-yellow-500 hover:bg-blue-700 text-white py-1 px-2">Copy</span>',
                    class: 'btn btn-warning btn-sm',
                },
                {
                    title: 'Patients Report',
                    extend: 'print',
                    text: '<span class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2">Print</span>',
                    class: 'btn btn-warning btn-sm',
                },
            ],
            ajax: {
                url: route('api.patients'),
                type: 'GET',
            },
            order: [[0, 'desc']],
            // language: {
            //     search: 'Search:',
            //     info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            //     infoFiltered: '(filtered from _MAX_ total entries)',
            //     infoEmpty: 'No data to show',
            //     lengthMenu: 'Show _MENU_ entries',
            //     zeroRecords: 'No matching records found',
            //     paginate: {
            //         first: 'First',
            //         last: 'Last',
            //         next: 'Next',
            //         previous: 'Previous',
            //     },
            // },
        },
    }),
}
</script>

<template>
    <Patients title="New Patient">
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="responsive">
                                <DataTable id="patients_dt" :columns="columns" :options="options" class="table display"></DataTable>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Patients>
</template>
