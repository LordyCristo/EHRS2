<template>
    <div v-if="options" v-show="showMenu" class="context-menu z-10 absolute border border-gray-200 rounded-md shadow-sm p-1 bg-white" :style="{ left: menuX + 'px', top: menuY + 'px' }">
        <ul class="list-none p-0 m-0">
            <li v-for="opt in options" @click="opt.func" class="flex dtBtn-sm items-center justify-start text-sm text-gray-700 hover:bg-gray-100 py-1 px-2 cursor-pointer"> <component :is="opt.icon" class="w-4" />
                {{ opt.title }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        showMenu: Boolean,
        options: {
            type: [Array, Object],
            required: false,
        },
    },
    data() {
        return {
            menuX: 0,
            menuY: 0,
        };
    },
    mounted() {
        document.addEventListener('contextmenu', this.handleContextMenu);
        document.addEventListener('click', this.hideContextMenu);
    },
    beforeDestroy() {
        document.removeEventListener('contextmenu', this.handleContextMenu);
        document.removeEventListener('click', this.hideContextMenu);
    },
    methods: {
        handleContextMenu(event) {
            event.preventDefault();
            this.menuX = event.clientX;
            this.menuY = event.clientY;
            this.$emit('show-menu', true);
        },
        hideContextMenu() {
            this.$emit('show-menu', false);
        },
        doSomething1() {
            console.log('Action 1 clicked');
            this.hideContextMenu();
        },
        doSomething2() {
            console.log('Action 2 clicked');
            this.hideContextMenu();
        },
        doSomething3() {
            console.log('Action 3 clicked');
            this.hideContextMenu();
        },
    },
};
</script>
