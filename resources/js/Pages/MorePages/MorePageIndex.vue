<template>
    <MorePages>
        <div class="flex gap-3 h-fit justify-center w-full">
            <CardWithAction v-for="card in cards" :mainbtnlink="card.link">
                <template #number>{{ card.count }}</template>
                <template #title>{{ card.title }}</template>
                <template #description>{{ card.description }}</template>
            </CardWithAction>
        </div>
    </MorePages>
</template>
<script setup>
import MorePages from "@/Pages/MorePages.vue";
import {defineComponent} from "vue";
import CardWithAction from "@/Components/Generic/Modals/CardWithAction.vue";
</script>
<script>
export default {
    props: {
        collegesCount: Number,
        departmentsCount: Number,
        programsCount: Number,
        servicesCount: Number,
    },
    data: () => ({
        cards: [
            {title: 'Colleges', description: 'Manage colleges', link: route('more.college.index'), count: 0},
            {title: 'Departments', description: 'Manage departments', link: route('more.department.index'), count: 0},
            {title: 'Programs', description: 'Manage degree programs', link: route('more.program.index'), count: 0},
            {title: 'Services', description: 'Manage services', link: route('more.service.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.collegesCount;
        this.cards[1].count = this.departmentsCount;
        this.cards[2].count = this.programsCount;
        this.cards[3].count = this.servicesCount;
    }
}

</script>
