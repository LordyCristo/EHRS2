<template>
    <div v-for="item in cards" class="w-full h-fit px-4 py-5 bg-white rounded-md shadow-sm border">
        <div  class="flex flex-col gap-3">
            <div>
                <div class="mt-1 text-3xl font-semibold text-center text-gray-900">
                    {{ item.records_count }}
                </div>
                <div class="text-lg font-medium text-center text-gray-500 truncate">
                    {{item.title}}
                </div>
                <p class="text-xs text-gray-500 text-center">
                    {{item.description}}
                </p>
            </div>
            <div class="flex flex-col">
<!--                <Card title="College" :item="item.records_count_per_college" />-->
<!--                <Card title="Department" :item="item.records_count_per_department" />-->
<!--                <Card title="Program" :item="item.records_count_per_program" />-->
            </div>
            <Tab :labels="item.labels" :datasets="item.datasets" >
                <template #college>
                    <Card title="College" :item="item.records_count_per_college" />
                </template>
                <template #department>
                    <Card title="Department" :item="item.records_count_per_department" />
                </template>
                <template #program>
                    <Card title="Program" :item="item.records_count_per_program" />
                </template>
            </Tab>

        </div>
    </div>
</template>
<script>
    import Card from "@/Components/Generic/Dashboard/Card.vue";
    import Tab from "@/Components/Generic/Dashboard/Tab.vue";

    export default {
        components: {Tab, Card},
        props: {
            cards: {
                type: Object,
                required: true
            }
        }
    }
</script>
