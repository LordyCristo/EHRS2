<script setup>
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import CloseIcon from '@/Components/Icons/CloseIcon.vue';
import DownloadIcon from '@/Components/Icons/DownloadIcon.vue';
import RefreshIcon from '@/Components/Icons/RefreshIcon.vue';
import SpinnerIcon from '@/Components/Icons/SpinnerIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import { markRaw } from 'vue';
import axios from 'axios';
</script>
<script>
export default {
    props: {
        columns: {
            type: Array,
            required: true,
        },
        apiLink: {
            type: [Array, Object],
            required: true,
        }
    },
    data: () => ({
        processing: false,
        viewSize: true, // true means wide view
        pageStart: 0,
        totalCount: 0,
        pageNumber: 1,
        perPage: 10,
        pageSize: 10,
        sort: 'id',
        sortDir: 'asc',
        totalPages: 0,
        totalRecords: 0,
        search: null,
        searchBy: '*',
        selected: [],
        data: [],
    }),
    methods: {
        deleteRecord(id) {
            if (confirm(`Are you sure you want to delete this record?`)) {
                this.processing = true;
                axios.delete(route(this.apiLink.destroy, id))
                    .then(response => {
                        this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
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
                let completedCount = 0;
                const totalCount = this.selected.length;
                this.selected.forEach(id => {
                    axios.delete(route(this.apiLink.destroy, id))
                        .then(response => {
                            completedCount++;
                            if (completedCount === totalCount) {
                                this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                            completedCount++;
                            if (completedCount === totalCount) {
                                this.processing = false;
                            }
                        });
                });
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
        getData(pageNumber = 1, pageSize = 10, search = '', sort = this.sort, sortDir = this.sortDir) {
            this.processing = true;
            axios.get(route(this.apiLink.index), {
                params: {
                    page: pageNumber,
                    per_page: pageSize,
                    search: search,
                    search_by: this.searchBy,
                    sort: sort,
                    sort_dir: sortDir,
                }
            })
                .then(response => {
                    this.data = response.data.data;
                    this.totalCount = response.data.totalCount;
                    this.totalPages = response.data.totalPages;
                    this.totalRecords = response.data.totalCount;
                    this.pageStart = (pageNumber - 1) * pageSize + 1;
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
                this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
            }
        },
        previousPage() {
            if (this.pageNumber > 1) {
                this.pageNumber--;
                this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
            }
        },
        firstPage() {
            this.pageNumber = 1;
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        lastPage() {
            this.pageNumber = this.totalPages;
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        changePageSize() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        changePageNumber(page) {
            this.pageNumber = page;
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        changeSort() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        changeSearchBy() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
        },
        autoGetData() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
            //Auto get data every 5 minutes
            setInterval(() => {
                this.getData(this.pageNumber, this.pageSize, this.search, this.sort, this.sortDir);
            }, 3000000);
        },
        sortColumn(col) {
            if (col.name === this.sortedColumn) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';

            } else {
                this.sortedColumn = col.name;
                this.sortDir = 'asc';
            }
            this.getData(this.pageNumber, this.pageSize, this.search, this.sortedColumn, this.sortDir);
        },
        searchFilter() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sortedColumn, this.sortDir);
        },
        clearSearchBox() {
            this.search = null;
            this.getData(this.pageNumber, this.pageSize, this.search, this.sortedColumn, this.sortDir);
        },
        refreshData() {
            this.getData(this.pageNumber, this.pageSize, this.search, this.sortedColumn, this.sortDir);
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
        clearSelected() {
            this.selected = [];
        },
        changeSizeView(){
            this.viewSize = !this.viewSize;
        }
    },
    mounted() {
        //Initialize the data request
        this.autoGetData();
    },
}
</script>
<template>
    <div class="dtContainer responsive">
        <div id="processing-cover" v-if="processing"
            class="bg-gray-200 text-gray-900 opacity-50 absolute min-h-screen min-w-full flex justify-center items-center z-50">
            <h1 class="text-2xl flex">
                <SpinnerIcon class="animate-spin w-7 mr-3" />
                Please Wait...
            </h1>
        </div>
        <div class="dtHeader flex justify-between mb-2">
            <div class="dtLength">
                <label for="dtLength">Show</label>
                <select name="dtLength" id="dtLength" v-model="pageSize" class="dtLengthSelect" @change="changePageSize()">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="dtLengthText">entries</span>
            </div>
            <div class="dtToolbar flex items-center">
                <button class="addbtn dtBtn-sm flex">
                    <AddIcon class="w-4 mr-1" />
                    New
                </button>
                <button @click="refreshData()" class="refreshBtn dtBtn-sm flex">
                    <RefreshIcon class="w-4 mr-1" />
                    Refresh
                </button>
                <button @click="exportToExcel()" class="excelExport dtBtn-sm flex">
                    <DownloadIcon class="w-4 mr-1" />
                    Excel
                </button>
                <button @click="deleteSelected()" v-if="selected.length > 1" class="deleteSelected dtBtn-sm flex">
                    <DeleteIcon class="w-4 mr-1" />
                    Delete Selected
                </button>
                <button class="dtBtn-sm">
                    <template v-if="viewSize">Small View</template>
                    <template v-else>Large View</template>
                </button>
            </div>
            <div class="dtSearch flex h-8 shadow-sm rounded-sm">
                <div class="flex items-center  rounded-sm border">
                    <select class="dtSearchBy" name="searchBy" id="searchBy" v-model="searchBy" @change="changeSearchBy()">
                        <option value="*" selected>All</option>
                        <template v-for="col in columns">
                            <option v-if="col.searchable" :value="col.name" :key="col.id">{{ col.title
                            }}</option>
                        </template>
                    </select>
                    <input v-model="search" class="dtSearchBox" type="text" placeholder="Search" aria-label="Search box">
                    <button v-if="search" @click="clearSearchBox()" class="dtSearchClear" type="button">
                        <close-icon class="h-3 w-3" />
                    </button>
                    <button v-if="search" class="dtSearchBtn" @click="searchFilter()">Search</button>
                </div>
            </div>
        </div>
        <table class="dtTable" ref="table">
            <thead class="dtHead">
                <tr class="dtHeaderRow">
                    <template v-for="col in columns" :key="col.data">
                        <th class="dtHeader"
                            @click="sortColumn(col)">
                            {{ col.title }}
                        </th>
                    </template>
                </tr>
            </thead>
            <tbody class="dtBody">
                <tr v-if="processing">
                    <td :colspan="columns.length" class="text-center">Retrieving data...</td>
                </tr>
                <tr class="dtBodyRow hover:bg-gray-200" v-else-if="data.length" v-for="item in data"
                    @click="selectRecord($event, item.id)" :class="{ 'selected-row': selected.includes(item.id) }">
                    <template v-for="col in columns" :key="col.data">
                        <td class="dtData whitespace-nowrap" :class="col.className">
                            <!-- for data -->
                            <template v-if="col.data">
                                {{ item[col.data] }}
                            </template>
                            <!-- for actions -->
                            <template v-else-if="col.icon">
                                <div class="flex justify-evenly w-full">
                                    <a @click="deleteRecord(item.id)"
                                        v-if="selected.length <= 1 && selected.includes(item.id)"
                                        class="w-5 flex hover:text-red-600 hover:scale-110 translate-x-0 text-red-500 duration-1000 ease-in">
                                        <component :is="col.icon[0]" />
                                    </a>
                                    <a @click="editRecordForm(item.id)"
                                        v-if="selected.length <= 1 && selected.includes(item.id)"
                                        class="w-5 flex hover:text-yellow-600 hover:scale-110 translate-x-0 text-yellow-500 duration-1000 ease-in">
                                        <component :is="col.icon[1]" />
                                    </a>
                                </div>
                            </template>
                        </td>
                    </template>
                </tr>

                <tr v-else>
                    <td :colspan="columns.length" class="text-center">No data available</td>
                </tr>
            </tbody>
        </table>
        <div class="dtFooter min-w-full flex justify-between text-sm px-1">
            <div class="flex items-center">
                <span>Showing {{ pageStart }} to {{ pageStart + data.length - 1 }} of {{
                    totalRecords }} entries</span>
            </div>
            <div class="flex items-center" v-if="selected.length > 1">
                <span>Selected {{ selected.length }} rows</span>
                <button @click="clearSelected()" class="dtClearSelected dtBtn-sm">Deselect</button>
            </div>
            <div class="flex" v-if="totalPages > 1">
                <template v-for="i in totalPages" :key="i">
                    <button :class="{'bg-gray-300': i === pageNumber }" class="dtBtn-sm border" @click="changePageNumber(i)">
                        {{ i }}
                    </button>
                </template>
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

.ascDesc::after {
    content: '▲▼';
}

.dtTable {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    font-size: small;
}

.dtContainer .dtFooter {
    border-top: none;
    @apply py-1;
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

.dt-center {
    text-align: center;
}

.dt-border-sm,
.dtHead .dtHeaderRow,
.dtContainer .dtFooter,
.dtTable  {
    @apply border-gray-200 border;
}

.dtLastPage,
.dtNextPage,
.dtPreviousPage,
.dtFirstPage{
    @apply hover:bg-gray-200 border-gray-200 bg-gray-300 border;
}

.dtSearch .dtLength {
    @apply flex items-center shadow-sm;
}

.dtLength .dtLengthSelect{
    @apply rounded-sm shadow-sm border-gray-200 appearance-none bg-transparent w-auto h-8 text-gray-700 py-1 px-2 pr-7 mx-1 leading-tight focus:outline-none;
}

.dtSearch .dtSearchBox{
    @apply appearance-none border-gray-200 w-full h-8 text-gray-700 py-1 px-2 leading-tight focus:outline-none;
}

.dtSearch .dtSearchBy{
    @apply rounded-s-sm appearance-none bg-transparent border-none w-auto h-8 text-gray-700 py-1 px-2 pr-7 leading-tight focus:outline-none;
}

.dtSearch .dtSearchBtn{
    @apply h-8 flex items-center flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded-e-sm;
}

.dtSearch .dtSearchClear{
    @apply h-8 flex items-center flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2;
}

.selected-row{
    @apply bg-gray-300 text-gray-900;
}

.dtBtn-sm{
    @apply flex items-center text-sm flex-shrink-0 py-0.5 px-2 mx-0.5 shadow-sm rounded-sm;
}

.excelExport{
    @apply bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-white;
}

.refreshBtn{
    @apply bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-white;
}

.addbtn{
    @apply bg-yellow-500 hover:bg-yellow-700 border-yellow-500 hover:border-yellow-700 text-white;
}

.dtClearSelected{
    @apply bg-orange-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-white;
}

.deleteSelected{
    @apply bg-red-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-white;
}
</style>
