<template>
    <div class="min-h-screen my-6">
        <!-- <div>
            <slot name="logo" />
        </div> -->
        <div class="text-xl w-fit font-bold text-vsu-green mx-auto mt-6">
            <slot name="title" />
        </div>
        <p class="text-gray-600 w-fit mx-auto text-sm mb-6">
            <slot name="description" />
        </p>

        <div class="w-full sm:max-w-md mx-auto px-6 py-4 bg-gray-100 shadow-md overflow-hidden md:rounded-lg">
            <slot />
        </div>
    </div>
</template>
