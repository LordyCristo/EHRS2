<template>
    <div class="flex flex-col gap-1">
        <div class="flex gap-1">
            <div v-for="tab in tabs">
                <button @click="setActiveTab(tab)" :class="activeTab.id === tab.id?'bg-vsu-green text-white':'bg-gray-200'" class="shadow-md text-md active:scale-95 duration-300 text-gray-900 border px-3 py-0.5 rounded-md">{{ tab.name }}</button>
            </div>
        </div>
        <div class="border p-1">
            <template v-for="page in tabs">
                {{activeTab.id === page.id}}
                <slot :show="activeTab.id === page.id" :name="page.id" />
            </template>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        tabs: Array,
    },
    data() {
        return {
            activeTab: this.tabs[0],
        };
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>
