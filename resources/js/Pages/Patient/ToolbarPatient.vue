<script>
import Navbar from '@/Components/Generic/Layout/Navbar.vue';
import ToolbarItem from '@/Components/Generic/Layout/ToolbarItem.vue';
import DeleteIcon from '@/Components/Icons/DeleteIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import EditIcon from '@/Components/Icons/EditIcon.vue';
import { markRaw } from 'vue';

export default {
    components: {
        Navbar,
        ToolbarItem,
        DeleteIcon,
        AddIcon,
        EditIcon,
    },
    data(){
        return{
            items:[
                {
                    title: 'ADD',
                    icon: markRaw(AddIcon),
                    link: 'newPatient',
                },
                {
                    title: 'EDIT',
                    icon: markRaw(EditIcon),
                    link: 'editPatient',
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
