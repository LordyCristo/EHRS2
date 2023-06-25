<template>
    <Laboratory>
        <div class="flex gap-3 h-fit justify-center w-full">
            <template v-for="card in cards">
                <CardWithAction v-if="card.show" :mainbtnlink="card.link" :id="card.id">
                    <template #number>{{ card.count }}</template>
                    <template #title>{{ card.title }}</template>
                    <template #description>{{ card.description }}</template>
                </CardWithAction>
            </template>
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
        labrequestCount: Number,
    },
    data: () => ({
        cards: [
            {id: 'labrequest', show: true, title: 'Laboratory Requests', description: 'Manage Laboratory Requests', link: route('laboratory.requests.index'), count: 0},
            {id: 'hematology', show: true, title: 'Hematology', description: 'Manage Hematology Records', link: route('laboratory.hematology.index'), count: 0},
            {id: 'fecalysis', show: true, title: 'Fecalysis', description: 'Manage Fecalysis Records', link: route('laboratory.fecalysis.index'), count: 0},
            {id: 'urinalysis', show: true, title: 'Urinalysis', description: 'Manage Urinalysis Records', link: route('laboratory.urinalysis.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.labrequestCount? this.labrequestCount : 0;
        this.cards[1].count = this.hematologyCount? this.hematologyCount : 0;
        this.cards[2].count = this.fecalysisCount? this.fecalysisCount : 0;
        this.cards[3].count = this.urinalysisCount? this.urinalysisCount : 0;

        this.cards[0].show = this.$page.props.auth.user.role === 7 || this.$page.props.auth.user.role === 1;
        this.cards[1].show = this.$page.props.auth.user.role === 2 || this.$page.props.auth.user.role === 1;
        this.cards[2].show = this.$page.props.auth.user.role === 2 || this.$page.props.auth.user.role === 1;
        this.cards[3].show = this.$page.props.auth.user.role === 2 || this.$page.props.auth.user.role === 1;
    }
}

</script>
