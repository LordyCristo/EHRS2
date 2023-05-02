<script setup>
import Navbar from '@/Components/Generic/Layout/Navbar.vue';
import ToolbarItem from '@/Components/Generic/Layout/ToolbarItem.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
</script>

<script>
import { markRaw } from 'vue';

export default {
    data(){
        return{
            items:[
                {
                    title: 'ADD',
                    icon: markRaw(AddIcon),
                    link: 'newRecord',
                },
                {
                    title: 'EDIT',
                    icon: markRaw(EditIcon),
                    link: 'editRecord',
                },
                {
                    title: 'DELETE',
                    icon: markRaw(DeleteIcon),
                }
            ]
        }
    },
}
</script>
<template>
    <Navbar>
        <ToolbarItem v-for="item in items" :link="item.link" :action="item.action">
            <template #icon>
                <component :is="item.icon" class="w-4 mr-1"/>
            </template>
            {{ item.title }}
        </ToolbarItem>
    </Navbar>
</template>
