<template>
    <Radiology>
        <div class="flex gap-3 h-fit justify-center w-full">
            <CardWithAction v-for="card in cards" :mainbtnlink="card.link" :id="card.id">
                <template #number>{{ card.count }}</template>
                <template #title>{{ card.title }}</template>
                <template #description>{{ card.description }}</template>
            </CardWithAction>
        </div>
    </Radiology>
</template>
<script setup>
import Radiology from "@/Pages/Radiology.vue";
import {defineComponent} from "vue";
import CardWithAction from "@/Components/Generic/Modals/CardWithAction.vue";
</script>
<script>
export default {
    props: {
        requestsCount: Number,
        resultsCount: Number,
    },
    data: () => ({
        cards: [
            {id: 'xray_request', title: 'X-ray Requests', description: 'List of X-ray requests', link: route('radiology.request.index'), count: 0},
            {id: 'xray_result', title: 'X-ray Results', description: 'List of Xr-ray results', link: route('radiology.result.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.requestsCount? this.requestsCount : 0;
        this.cards[1].count = this.resultsCount? this.resultsCount : 0;
    }
}

</script>
