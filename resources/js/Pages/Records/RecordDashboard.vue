<script setup>
import Records from '@/Pages/MedicalRecords.vue';
</script>
<script>
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import DataTableLib from 'datatables.net-bs5';
import DataTableCore from 'datatables.net';
import Button from 'datatables.net-buttons-bs5';
import ButtonHtml5 from 'datatables.net-buttons/js/buttons.html5';
import print from 'datatables.net-buttons/js/buttons.print';
import pdfmake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import 'datatables.net-responsive-bs5';
pdfmake.vfs = pdfFonts.pdfMake.vfs;

import JsZip from 'jszip';
window.JSZip = JsZip;
DataTable.use(DataTableCore);
DataTable.use(pdfmake);
DataTable.use(ButtonHtml5);

export default {
    components: {
        DataTable,
    },
    data() {
        return {
            columns: [
                { data: 'id', title: 'ID' },
                { data: 'name', title: 'Name' },
                { data: 'abbr', title: 'Abbr' },
                { data: 'major', title: 'Major' },
                { data: 'department_id', title: 'Department' },
                //{data: 'action', title: 'Action', orderable: false, searchable: false},
            ],
            data: null,
            options: {
                responsive: true,
                autoWidth: false,
                processing: true,
                dom: 'Bfrltip',
                buttons: [
                    {
                        title: 'New Product',
                        extend: 'excelHtml5',
                        text: '<span class="bg-green-500 hover:bg-blue-700 text-white py-1 px-2">Excel</span>',
                        class: '',
                    },
                    {
                        title: 'New Product',
                        extend: 'pdfHtml5',
                        text: '<span class="bg-red-500 hover:bg-blue-700 text-white py-1 px-2">PDF</span>',
                        class: 'btn btn-danger btn-sm',
                    },
                    {
                        title: 'New Product',
                        extend: 'copy',
                        text: '<span class="bg-yellow-500 hover:bg-blue-700 text-white py-1 px-2">Copy</span>',
                        class: 'btn btn-warning btn-sm',
                    },
                    {
                        title: 'New Product',
                        extend: 'print',
                        text: '<span class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2">Print</span>',
                        class: 'btn btn-warning btn-sm',
                    },
                ],
            },
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts() {
            axios.get(route('api.programs'))
                .then(response => {
                    this.data = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },
}
</script>
<template>
    <Records title="Medical Records">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="responsive">
                                <DataTable :data="data" :columns="columns" :options="options"
                                    class="table table-striped tabled-bordered display"></DataTable>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Records>
</template>
