<script setup>
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import CloseIcon from '@/Components/Icons/CloseIcon.vue';
import DownloadIcon from '@/Components/Icons/DownloadIcon.vue';
import RefreshIcon from '@/Components/Icons/RefreshIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import CollapseIcon from "@/Components/Icons/CollapseIcon.vue";
import ExpandIcon from "@/Components/Icons/ExpandIcon.vue";
import CheckallIcon from "@/Components/Icons/CheckallIcon.vue";
import UploadIcon from "@/Components/Icons/UploadIcon.vue";
import DtLength from "@/Components/DataTable/DtComponents/DtLength.vue";
import DtSearch from "@/Components/DataTable/DtComponents/DtSearch.vue";
import DtSearchBy from "@/Components/DataTable/DtComponents/DtSearchBy.vue";
import DtProcessing from "@/Components/DataTable/DtComponents/DtProcessing.vue";
import DtPaginateBtn from "@/Components/DataTable/DtComponents/DtPaginateBtn.vue";
import DtPaginateDetail from "@/Components/DataTable/DtComponents/DtPaginateDetail.vue";
import DtPageBtn from "@/Components/DataTable/DtComponents/DtPageBtn.vue";
import DtActionBtn from "@/Components/DataTable/DtComponents/DtActionBtn.vue";
import DtTHead from "@/Components/DataTable/DtComponents/DtTHead.vue";
import DtTh from "@/Components/DataTable/DtComponents/DtTh.vue";
import DtBody from "@/Components/DataTable/DtComponents/DtBody.vue";
</script>
<script>
import { markRaw } from 'vue';
import axios from 'axios';
import { Link } from "@inertiajs/vue3";

export default {
    props: {
        columnsLarge: {
            type: Array,
            required: true,
        },
        columnsSmall: {
            type: Array,
            required: true,
        },
        apiLink: {
            type: [Array, Object],
            required: true,
        },
    },
    data: () => ({
        showMenu: false,
        columns: [],    // columns to be displayed
        processing: false, // show spinner
        viewSize: false, // default is large view
        pageStart: 0,
        totalCount: 0,
        pageNumber: 1,
        perPage: 10,
        pageSize: 20,
        sortedColumn: 'id', // default column to be sorted
        sortDir: 'desc', // default sort direction
        totalPages: 0,
        totalRecords: 0,
        search: null,
        searchBy: '*',
        selected: [],
        currentPageSelected: [],
        completedCount: 0,
        data: [],
        DtLengthOptions: [20, 50, 100, 200],
        contextMenu: [
            {
                title: 'Delete',
                func: null,
                icon: markRaw(DeleteIcon),
            },
            {
                title: 'Edit',
                func: null,
                icon: markRaw(EditIcon),
            }
        ],
        actionButton: {
            data: null,
            icon: [markRaw(DeleteIcon), markRaw(EditIcon)],
            name: 'actions',
            title: 'Actions',
            searchable: false,
            orderable: false,
            collapsable: false,
            className: 'dt-center flex justify-center',
        }
    }),
    mounted() {
        //Initialize the data request
        this.autoGetData();
        this.changeSizeView();
    },
    methods: {
        deleteRecord(id) {
            if (confirm(`Are you sure you want to delete this record?`)) {
                this.processing = true;
                axios.delete(route(this.apiLink.destroy, { college: id }))
                    .then(response => {
                        console.log(response);
                        this.getData();
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.processing = false;
                    });
            }
        },
        deleteSelected() {
            if (confirm(`Are you sure you want to delete these ${this.selected.length} records?`)) {
                this.processing = true;
                this.completedCount = 0;
                const totalCount = this.selected.length;
                this.selected.forEach(id => {
                    axios.delete(route(this.apiLink.destroy, id))
                        .then(response => {
                            this.completedCount++;
                            if (this.completedCount === totalCount) {
                                this.getData();
                            }
                        })
                        .catch(error => {
                            console.log(error);
                            this.completedCount++;
                            if (this.completedCount === totalCount) {
                                this.processing = false;
                            }
                        });
                });
                this.completedCount = 0;
                this.selected = [];
            }
        },
        selectRecord(event, id) {
            // Check if the ctrl key is held down
            const ctrlKey = event.metaKey || event.ctrlKey;

            if (this.selected.includes(id)) {
                // Remove the record from the selection
                this.selected = this.selected.filter(i => i !== id);
            } else {
                // Add the record to the selection
                if (ctrlKey) {
                    // Multi-select mode, add to selection
                    this.selected.push(id);
                } else {
                    // Single-select mode, replace selection with this record
                    this.selected = [id];
                }
            }
        },
        selectAll() {
            if (this.selected.length < this.totalRecords) {
                this.data.forEach(record => {
                    if (!this.selected.includes(record.id)) {
                        this.selected.push(record.id);
                        this.currentPageSelected.push(record.id);
                    }
                });
            } else {
                this.selected = [];
                this.currentPageSelected = [];
            }
        },
        deselectAll() {
            this.selected = [];
            this.currentPageSelected = [];
        },
        getData() {
            this.processing = true;
            axios.get(route(this.apiLink.table), {
                params: {
                    page: this.pageNumber,
                    per_page: this.pageSize,
                    search: this.search,
                    search_by: this.searchBy,
                    sort: this.sortedColumn,
                    sort_dir: this.sortDir,
                }
            })
                .then(response => {
                    this.data = response.data.data;
                    this.totalCount = response.data.totalCount;
                    this.totalPages = response.data.totalPages;
                    this.totalRecords = response.data.totalCount;
                    this.pageStart = (this.pageNumber - 1) * this.pageSize + 1;
                    this.processing = false;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.processing = false;
                });
        },
        nextPage() {
            if (this.pageNumber < this.totalPages) {
                this.pageNumber++;
                this.getData();
            }
        },
        previousPage() {
            if (this.pageNumber > 1) {
                this.pageNumber--;
                this.getData();
            }
        },
        firstPage() {
            if(this.pageNumber === 1)
                return;
            this.pageNumber = 1;
            this.getData();
        },
        lastPage() {
            if(this.pageNumber === this.totalPages)
                return;
            this.pageNumber = this.totalPages;
            this.getData();
        },
        changePageNumber(page) {
            this.pageNumber = page;
            this.getData();
        },
        autoGetData() {
            this.getData();
            //Auto get data every 5 minutes
            setInterval(() => {
                this.getData();
            }, 3000000);
        },
        sortColumn(col) {
            if (!col.orderable)
                return;
            if (col.name === this.sortedColumn) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortedColumn = col.name;
                this.sortDir = 'asc';
            }
            this.getData();
        },
        clearSearchBox() {
            this.search = null;
            this.getData();
        },
        refreshData() {
            this.getData();
        },
        changeSizeView(){
            this.viewSize = !this.viewSize;
            if (this.viewSize) {
                this.columns = this.columnsLarge;
            } else {
                this.columns = this.columnsSmall;
            }
            // only append the action column if it is not in the columns array
            if (!this.columns.includes(this.actionButton)) {
                this.columns.push(this.actionButton);
            }
        },
        exportToCsv() {
            this.processing = true;
            axios.get(route(this.apiLink.index),)
                .then((response) => {
                    const filename = 'export.csv';
                    const rows = response.data;
                    console.log(response);
                    // Convert the array of objects to a CSV string
                    const rowsArray = Array.from(rows);
                    // append infront the header row, get the column headers from the database
                    rowsArray.unshift(Object.keys(rows[0]));
                    const csvData = rowsArray.map(row => Object.values(row).map(val => {
                        if (val === null) {
                            return '""';
                        }
                        // convert val to string and check if it contains a comma and trim
                        val = val.toString().trim();
                        val = val.replace(/(\r\n|\n|\r)/gm, "");
                        if (val.includes(',')) {
                            // escape the comma
                            val = `"${val}"`;
                        }
                        return val;
                    }).join(",")).join("\n");

                    const blob = new Blob([csvData], { type: 'text/csv;charset=utf-8;' });
                    if (navigator.msSaveBlob) {
                        navigator.msSaveBlob(blob, filename);
                    } else {
                        const link = document.createElement('a');
                        if (link.download !== undefined) {
                            const url = URL.createObjectURL(blob);
                            link.setAttribute('href', url);
                            link.setAttribute('download', filename);
                            link.style.visibility = 'hidden';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.processing = false;
                });
        },
        importFromCsv() {
            this.processing = true;
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.csv';
            fileInput.onchange = () => {
                const file = fileInput.files[0];
                const reader = new FileReader();
                reader.readAsText(file);
                reader.onload = () => {
                    const csvData = reader.result;
                    const rowsArray = csvData.split('\n');
                    const headers = rowsArray[0].split(',');
                    const rows = [];
                    for (let i = 1; i < rowsArray.length; i++) {
                        // split the row into values and can handle commas inside double quotes
                        const values = rowsArray[i].split(/,(?=(?:(?:[^"]*"){2})*[^"]*$)/);
                        const row = {};
                        for (let j = 0; j < headers.length; j++) {
                            // if the value is empty, set it to null
                            if (values[j] === "\"\"" || values[j] === undefined || values[j] === null) {
                                values[j] = null;
                            }
                            row[headers[j]] = values[j];
                        }
                        rows.push(row);
                    }
                    // Send the imported data to the server
                    axios.post(route(this.apiLink.import), rows)
                        .then((response) => {
                            // Refresh the data table
                            this.getData();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                };
            };
            fileInput.click();
        },
        isColumnSorted(col) {
            return col.name === this.sortedColumn;
        },
    },
    computed: {
        isAllSelected() {
            return this.selected.length < this.totalRecords;
        },
    }
}
</script>
<template>
    <div class="w-full flex justify-center">
<!--        <DtProcessing v-if="processing" >{{ completedCount? completedCount:'' }}</DtProcessing>-->
        <div class="min-w-full" >
            <div class="flex items-center gap-2 py-1">
                <DtActionBtn :href="route(apiLink.create)" class="bg-yellow-500">
                    <AddIcon class="w-4 mr-1" />
                    New
                </DtActionBtn>
                <DtActionBtn @click="refreshData" class="bg-blue-500">
                    <RefreshIcon class="w-4 mr-1" />
                    Refresh
                </DtActionBtn>
                <DtActionBtn v-if="totalRecords" @click="exportToCsv" class="bg-green-600">
                    <DownloadIcon class="w-4 mr-1" />
                    Export
                </DtActionBtn>
                <DtActionBtn @click="importFromCsv" class="bg-teal-600">
                    <UploadIcon class="w-4 mr-1" />
                    Import
                </DtActionBtn>
                <DtActionBtn v-if="selected.length > 1" @click="deleteSelected" class="bg-red-600">
                    <DeleteIcon class="w-4 mr-1" />
                    Delete
                </DtActionBtn>
                <DtActionBtn @click="changeSizeView" class="bg-vsu-yellow-green">
                    <template v-if="viewSize">
                        <CollapseIcon class="w-3 mr-1" />
                        Collapse
                    </template>
                    <template v-else>
                        <ExpandIcon class="w-3 mr-1" />
                        Expand
                    </template>
                </DtActionBtn>
                <DtActionBtn  v-if="isAllSelected" @click="selectAll" class="bg-orange-500">
                    <CheckallIcon class="w-4 mr-1" />
                    Select All
                </DtActionBtn>
                <DtActionBtn v-if="selected.length" class="bg-vsu-olive" @click="deselectAll">
                    <CloseIcon class="w-4 mr-1" />
                    Deselect All
                </DtActionBtn>
            </div>
            <div class="py-1 flex justify-between mb-2 gap-2">
                <DtLength :options="DtLengthOptions" v-model="pageSize" @change="refreshData" />
                <div class="flex items-center rounded-sm shadow-sm border">
                    <DtSearchBy v-model="searchBy" :columns="columns" @change="refreshData()" />
                    <DtSearch :func="refreshData" v-model="search" :searchBy="searchBy" :columns="columns" />
                </div>
            </div>
            <table class="w-full border-collapse text-sm" ref="table">
                <DtTHead>
                    <DtTh v-for="col in columns" :key="col.data" :title="col.title" @click="sortColumn(col)" :sortDir="sortDir" :isSortedColumn="isColumnSorted(col)" />
                </DtTHead>
                <DtBody>
                    <tr v-if="processing">
                        <td :colspan="columns.length" class="text-center">Retrieving data...</td>
                    </tr>
                    <tr v-else-if="!data.length">
                        <td :colspan="columns.length" class="text-center">No data available</td>
                    </tr>
                    <tr v-for="item in data" v-else
                        :class="{ 'bg-gray-300 text-gray-900 border': selected.includes(item.id) }"
                        class="dtBodyRow hover:bg-gray-200 border-r"
                        @click="selectRecord($event, item.id)">
                        <template v-for="col in columns" :key="col.data">
                            <!-- for data -->
                            <td v-if="col.data" class="dtData whitespace-nowrap border-gray-200 border" :class="col.className">
                                {{ item[col.data] }}
                            </td>
                            <!-- for actions -->
                            <td v-else-if="col.icon" class="dtData whitespace-nowrap border-none" :class="col.className">
                                <div class="flex justify-evenly container">
                                    <a @click="deleteRecord(item.id)"
                                       v-if="selected.length <= 1 && selected.includes(item.id)"
                                       class="w-5 flex hover:text-red-600 hover:scale-110 translate-x-0 text-red-500 duration-1000 ease-in">
                                        <component :is="col.icon[0]" />
                                    </a>
                                    <Link :href="route(apiLink.edit, {college: item })"
                                          v-if="selected.length <= 1 && selected.includes(item.id)"
                                          class="w-5 flex hover:text-yellow-600 hover:scale-110 translate-x-0 text-yellow-500 duration-1000 ease-in">
                                        <component :is="col.icon[1]" />
                                    </Link>
                                </div>
                            </td>
                        </template>
                    </tr>
                </DtBody>
            </table>
            <div class="p-1 border border-t-0 min-w-full flex justify-between text-sm bottom-0">
                <DtPaginateDetail>Showing {{ pageStart }} to {{ pageStart + data.length - 1 }} of {{ totalRecords }} entries</DtPaginateDetail>
                <DtPageBtn :selected="selected" :totalPages="totalPages" :pageNumber="pageNumber" :changePageNumber="changePageNumber" />
                <div class="flex items-center">
                    <DtPaginateBtn :func="firstPage" :disabled="pageNumber === 1">First</DtPaginateBtn>
                    <DtPaginateBtn :func="previousPage" :disabled="pageNumber === 1">Previous</DtPaginateBtn>
                    <DtPaginateBtn :func="nextPage" :disabled="pageNumber === totalPages">Next</DtPaginateBtn>
                    <DtPaginateBtn :func="lastPage" :disabled="pageNumber === totalPages">Last</DtPaginateBtn>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.asc::after {
    content: '▲';
}

.desc::after {
    content: '▼';
}
</style>
