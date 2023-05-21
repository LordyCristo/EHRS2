<template>
    <Navbar>
<!--        <ToolbarItem v-for="item in items" :link="item.link" :action="item.action">-->
<!--            <template #icon>-->
<!--                <component :is="item.icon" class="w-4 mr-1" />-->
<!--            </template>-->
<!--            {{ item.title }}-->
<!--        </ToolbarItem>-->
    <div class="w-full flex justify-center">
        {{ currentDate }} {{ currentTime }}
    </div>
    </Navbar>
</template>
<script setup>
import Navbar from '@/Components/Generic/Layout/Navbar.vue';
//import ToolbarItem from '@/Components/Generic/Layout/ToolbarItem.vue';
</script>
<script>
import { markRaw } from 'vue';
import HomeIcon from '@/Components/Icons/HomeIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
export default {
    data() {
        return {
            items: [
                {
                    title: 'Patients',
                    icon: markRaw(HomeIcon),
                    link: 'patients',
                },
                {
                    title: 'Add',
                    icon: markRaw(AddIcon),
                    link: 'newPatient',
                },
            ],
            currentDate: null,
            currentTime: null,
        }
    },
    mounted() {
        this.updateDateTime();
        setInterval(this.updateDateTime, 1000); // Update every second
    },
    methods: {
        updateDateTime() {
            const currentDateTime = new Date();
            this.currentDate = currentDateTime.toDateString();
            this.currentTime = currentDateTime.toLocaleTimeString();
        },
    },
}
</script>
