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
                axios.delete(route(this.apiLink.destroy, id))
                    .then(response => {
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
        editRecordForm(id) {
            axios.get(route(this.apiLink.edit, id))
                .then(response => {
                    this.$emit('editRecordForm', response.data);
                })
                .catch(error => {
                    console.log(error);
                });
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
            //this.selected = [];
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
            axios.get(route(this.apiLink.index), {
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
            axios.get(route(this.apiLink.getall), {
                    params: {
                        page: this.pageNumber,
                        per_page: this.pageSize,
                        search: this.search,
                        search_by: this.searchBy,
                        sort: this.sortedColumn,
                        sort_dir: this.sortDir,
                    },
                })
                .then((response) => {
                    const filename = 'export.csv';
                    const rows = response.data;
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
    },
}
</script>
<template>
    <div class="w-full flex justify-center">
        <DtProcessing v-if="processing" >{{ completedCount? completedCount:'' }}</DtProcessing>
        <div v-else class="max-w-fit">
            <div class="dtHeader flex justify-between mb-2 gap-2">
                <DtLength :options="DtLengthOptions" v-model="pageSize" @change="refreshData" />
                <div class="dtToolbar flex items-center">
                    <Link :href="route(apiLink.create)" class="addbtn dtBtn-sm">
                        <AddIcon class="w-4 mr-1" />
                        New
                    </Link>
                    <button class="refreshBtn dtBtn-sm" @click="refreshData()">
                        <RefreshIcon class="w-4 mr-1" />
                        Refresh
                    </button>
                    <button class="excelExport dtBtn-sm" @click="exportToCsv()">
                        <DownloadIcon class="w-4 mr-1" />
                        Excel
                    </button>
                    <button class="excelImport dtBtn-sm" @click="importFromCsv()">
                        <UploadIcon class="w-4 mr-1" />
                        Import
                    </button>
                    <button v-if="selected.length > 1" class="deleteSelected dtBtn-sm" @click="deleteSelected()">
                        <DeleteIcon class="w-4 mr-1" />
                        Delete Selected
                    </button>
                    <button class="viewBtn dtBtn-sm" @click="changeSizeView()">
                        <template v-if="viewSize">
                            <CollapseIcon class="w-3 mr-1" />
                            Collapse
                        </template>
                        <template v-else>
                            <ExpandIcon class="w-3 mr-1" />
                            Expand
                        </template>
                    </button>
                    <button v-if="selected.length < pageSize * pageNumber" class="dtSelectAll dtBtn-sm" @click="selectAll()">
                        <CheckallIcon class="w-4 mr-1" />
                        Select All
                    </button>
                    <button v-if=" selected.length > 1" class="dtClearSelected dtBtn-sm" @click="deselectAll()">
                        <CloseIcon class="w-4 mr-1" />
                        Deselect All
                    </button>
                </div>
                <div class="flex items-center rounded-sm shadow-sm border">
                    <DtSearchBy v-model="searchBy" :columns="columns" @change="refreshData()" />
                    <DtSearch :func="refreshData" v-model="search" :searchBy="searchBy" :columns="columns" />
                </div>
            </div>
            <table class="w-full border-collapse text-sm" ref="table">
                <thead class="dtHead">
                    <tr class="dtHeaderRow">
                        <template v-for="col in columns" :key="col.data">
                            <th v-if="col.name === sortedColumn" class="dtHeader bg-vsu-olive whitespace-nowrap"
                                @click="sortColumn(col)">
                                {{ col.title }}
                                <template v-if="sortDir === 'asc'">
                                    <span class="asc"></span>
                                </template>
                                <template v-else>
                                    <span class="desc"></span>
                                </template>
                            </th>
                            <th v-else class="dtHeader whitespace-nowrap"
                                @click="sortColumn(col)">
                                {{ col.title }}
                            </th>
                        </template>
                    </tr>
                </thead>
                <tbody class="dtBody max-h-screen overflow-y-scroll">
                    <tr v-if="processing">
                        <td :colspan="columns.length" class="text-center">Retrieving data...</td>
                    </tr>
                    <tr class="dtBodyRow hover:bg-gray-200 border-r" v-else-if="data.length" v-for="item in data"
                        @click="selectRecord($event, item.id)" :class="{ 'bg-gray-300 text-gray-900 border': selected.includes(item.id) }">
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
                                    <Link :href="route(apiLink.edit, item.id)"
                                          v-if="selected.length <= 1 && selected.includes(item.id)"
                                          class="w-5 flex hover:text-yellow-600 hover:scale-110 translate-x-0 text-yellow-500 duration-1000 ease-in">
                                        <component :is="col.icon[1]" />
                                    </Link>
                                </div>
                            </td>
                        </template>
                    </tr>
                    <tr v-else>
                        <td :colspan="columns.length" class="text-center">No data available</td>
                    </tr>
                </tbody>
            </table>
            <div class="p-1 border border-t-0 min-w-full flex justify-between text-sm bottom-0">
                <div class="flex items-center">
                    <span>Showing {{ pageStart }} to {{ pageStart + data.length - 1 }} of {{ totalRecords }} entries</span>
                </div>
                <div class="flex items-center" v-if="selected.length > 1">
                    <span>Selected {{ selected.length }} rows</span>
                </div>
                <div class="flex" v-if="totalPages > 1 && totalPages <= 10">
                    <template v-for="i in totalPages" :key="i">
                        <button :class="{'bg-gray-300': i === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(i)">
                            {{ i }}
                        </button>
                    </template>
                </div>
                <div class="flex overflow-hidden" v-else-if="totalPages > 1">
                    <button :class="{'bg-gray-300': 1 === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(1)">
                        1
                    </button>
                    <template v-if="pageNumber > 3">
                        <span class="px-2">&hellip;</span>
                    </template>
                    <template v-if="pageNumber > 2">
                        <button :class="{'bg-gray-300': pageNumber - 1 === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(pageNumber - 1)">
                            {{ pageNumber - 1 }}
                        </button>
                    </template>
                    <button v-if="pageNumber !== 1 && pageNumber !== totalPages" :class="{'bg-gray-300': pageNumber === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(pageNumber)">
                        {{ pageNumber }}
                    </button>
                    <template v-if="pageNumber < totalPages - 1">
                        <button :class="{'bg-gray-300': pageNumber + 1 === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(pageNumber + 1)">
                            {{ pageNumber + 1 }}
                        </button>
                    </template>

                    <template v-if="totalPages - pageNumber > 3">
                        <span class="px-2">&hellip;</span>
                    </template>
                    <button :class="{'bg-gray-300': totalPages === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(totalPages)">
                        {{ totalPages }}
                    </button>
                </div>
                <div class="flex items-center">
                    <button @click="firstPage" :class="{ 'opacity-50 cursor-not-allowed': pageNumber === 1 }"
                        class="dtFirstPage dtBtn-sm">First</button>
                    <button @click="previousPage" :class="{ 'opacity-50 cursor-not-allowed': pageNumber === 1 }"
                        class="dtPreviousPage dtBtn-sm">Previous</button>
                    <button @click="nextPage" :class="{ 'opacity-50 cursor-not-allowed': pageNumber === totalPages }"
                        class="dtNextPage dtBtn-sm">Next</button>
                    <button @click="lastPage" :class="{ 'opacity-50 cursor-not-allowed': pageNumber === totalPages }"
                        class="dtLastPage dtBtn-sm">Last</button>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
:root {
    --dtHeadColor: #000000;
}

.asc::after {
    content: '▲';
}

.desc::after {
    content: '▼';
}

.dtHead .dtHeaderRow {
    @apply bg-vsu-green;
    color: #ffffff;
    font-weight: bold;
    text-align: center;
}

.dtHead .dtHeader {
    padding: 0.3rem 1rem;
}

.dtLastPage,
.dtNextPage,
.dtPreviousPage,
.dtFirstPage{
    @apply hover:bg-gray-200 border-gray-200 bg-gray-300 border;
}

.dtBtn-sm{
    @apply flex items-center text-sm flex-shrink-0 py-0.5 px-2 mx-0.5 shadow-sm rounded-sm;
}

.excelExport{
    @apply bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-white;
}

.excelImport{
    @apply bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-white;
}

.refreshBtn{
    @apply bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-white;
}

.addbtn{
    @apply bg-yellow-500 hover:bg-yellow-700 border-yellow-500 hover:border-yellow-700 text-white;
}

.viewBtn{
    @apply bg-vsu-yellow-green hover:bg-vsu-light-green border-vsu-yellow-green hover:border-vsu-yellow-green text-white;
}

.dtSelectAll{
    @apply bg-orange-500 hover:bg-orange-700 border-orange-500 text-white;
}

.dtClearSelected{
    @apply bg-vsu-blue-green hover:bg-vsu-teal border-vsu-blue-green text-white;
}

.deleteSelected{
    @apply bg-red-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-white;
}
</style>
