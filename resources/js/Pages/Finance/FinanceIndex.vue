<template>
    <MorePages>
        <div class="flex flex-col w-full">
            <div class="flex gap-3 h-fit justify-center w-full">
                <CardWithAction v-for="card in cards" :mainbtnlink="card.link" :id="card.id">
                    <template #number>{{ card.count }}</template>
                    <template #title>{{ card.title }}</template>
                    <template #description>{{ card.description }}</template>
                </CardWithAction>
            </div>
            <div class="flex flex-col">
<!--                <div v-for="item in summary.totalRevenue" class="flex flex-row justify-between">-->
<!--                    <span>{{item.section_name}}: </span>-->
<!--                    <span>{{item.total}}</span>-->
<!--                </div>-->
                {{summary}}
            </div>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from "@/Pages/MorePages.vue";
import CardWithAction from "@/Components/Generic/Modals/CardWithAction.vue";
</script>
<script>
export default {
    props: {
        feesCount: Number,
        paymentsCount: Number,
        summary: Object,
    },
    data: () => ({
        cards: [
            {id: 'payments', title: 'Payments', description: 'List of departments', link: route('finance.payment.index'), count: 0},
            {id: 'fees', title: 'Fees', description: 'List of prices per service', link: route('finance.fee.index'), count: 0},
        ],
    }),
    methods: {
        getSummary() {
            axios.get(route('api.fee.revenue'))
                .then(response => {
                    this.summary = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.cards[0].count = this.paymentsCount? this.paymentsCount : 0;
        this.cards[1].count = this.feesCount? this.feesCount : 0;
        this.getSummary();
    }
}

</script>
