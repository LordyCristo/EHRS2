<template>
    <div>
        <div class="flex flex-row w-full bg-gray-100">
            <button v-for="(tab, index) in tabs" :key="index" @click="activeTab = tab" class="w-full text-sm py-0.5 px-2 hover:bg-gray-200 hover:border-gray-200" :class="{'bg-gray-400 shadow-lg border rounded-md border-gray-400 hover:bg-gray-300':activeTab === tab}">
                {{ tab }}
            </button>
        </div>
        <div class="tab-content max-h-60 overflow-y-auto" >
            <table v-if="activeTab === 'College'">
                <slot name="college" />
            </table>
            <table v-else-if="activeTab === 'Department'">
                <slot name="department" />
            </table>
            <table v-else-if="activeTab === 'Program'">
                <slot name="program" />
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            activeTab: 'College',
            tabs: ['College', 'Department', 'Program'],
        };
    },
};
</script>

<style>
.tab {
    display: flex;
}

.tab button {
    padding: 8px 16px;
    border: none;
    background-color: #f1f1f1;
    cursor: pointer;
}

.tab button:hover {
    background-color: #ddd;
}

.tab button:focus {
    outline: none;
}

.tab-content table {
    margin-top: 16px;
    width: 100%;
    border-collapse: collapse;
}

.tab-content table th,
.tab-content table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.tab-content table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.tab-content table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
