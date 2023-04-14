<template>
    <div class="min-h-screen flex flex-row">
        <!-- Items of the sidebar -->
        <slot name="items"></slot>
        <div class="flex flex-col flex-1">
            <!-- The body of the page which include the toolbar and the content -->
            <slot name="body"></slot>
        </div>

    </div>
</template>
