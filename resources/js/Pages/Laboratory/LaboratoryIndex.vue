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
    },
    data: () => ({
        cards: [
            {id: 'hematology', title: 'Hematology', description: 'Hematology Filed Records', link: route('laboratory.hematology.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.hematologyCount? this.hematologyCount : 0;
    }
}

</script>
