<template>
    <div class="flex flex-row items-center justify-center">
        <div class="flex flex-col items-center justify-center">
            <h1 class="font-bold"><slot name="title" /></h1>
            <div class="w-[30rem] h-auto px-4 py-5 bg-white rounded-lg mx-auto">
                <slot name="bar" />
            </div>
        </div>
        <div class="h-auto px-4 py-5 bg-white rounded-lg text-center">
            <slot name="pie" />
        </div>
    </div>
</template>
