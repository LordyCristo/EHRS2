<template>
    <Laboratory>
        <div class="flex gap-3 h-fit justify-center w-full">
            <CardWithAction v-for="card in cards" :mainbtnlink="card.link" :id="card.id">
                <template #number>{{ card.count }}</template>
                <template #title>{{ card.title }}</template>
                <template #description>{{ card.description }}</template>
            </CardWithAction>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from "@/Pages/Laboratories.vue";
import {defineComponent} from "vue";
import CardWithAction from "@/Components/Generic/Modals/CardWithAction.vue";
</script>
<script>
export default {
    props: {
        hematologyCount: Number,
        fecalysisCount: Number,
        urinalysisCount: Number,
    },
    data: () => ({
        cards: [
            {id: 'hematology', title: 'Hematology', description: 'Manage Hematology Filed Records', link: route('laboratory.hematology.index'), count: 0},
            {id: 'fecalysis', title: 'Fecalysis', description: 'Manage Fecalysis Filed Records', link: route('laboratory.fecalysis.index'), count: 0},
            {id: 'urinalysis', title: 'Urinalysis', description: 'Manage Urinalysis Filed Records', link: route('laboratory.urinalysis.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.hematologyCount? this.hematologyCount : 0;
        this.cards[1].count = this.fecalysisCount? this.fecalysisCount : 0;
        this.cards[2].count = this.urinalysisCount? this.urinalysisCount : 0;
    }
}

</script>
