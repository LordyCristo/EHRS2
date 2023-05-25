<template>
    <MorePages>
        <div class="flex gap-3 h-fit justify-center w-full">
            <CardWithAction v-for="card in cards" :mainbtnlink="card.link" :id="card.id">
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
            {id: 'colleges', title: 'Colleges', description: 'List of colleges', link: route('more.college.index'), count: 0},
            {id: 'departments', title: 'Departments', description: 'List of departments', link: route('more.department.index'), count: 0},
            {id: 'programs', title: 'Programs', description: 'List of degree programs', link: route('more.program.index'), count: 0},
            {id: 'services', title: 'Services', description: 'List of medical services', link: route('more.service.index'), count: 0},
        ]
    }),
    mounted() {
        this.cards[0].count = this.collegesCount? this.collegesCount : 0;
        this.cards[1].count = this.departmentsCount? this.departmentsCount : 0;
        this.cards[2].count = this.programsCount? this.programsCount : 0;
        this.cards[3].count = this.servicesCount? this.servicesCount : 0;
    }
}

</script>
