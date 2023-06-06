<template>
    <div v-if="item.length" >
        <template v-for="val in item">
            <div class="grid grid-cols-2 px-2 py-0.5 hover:bg-gray-200">
                <div :title="val.name">
                    {{val.abbr}}
                </div>
                <div class="text-right">
                    {{val.count}}
                </div>
            </div>
        </template>
    </div>
    <div v-else class="text-center text-gray-500">No records found</div>
</template>
<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true
            },
        }
    }
</script>
