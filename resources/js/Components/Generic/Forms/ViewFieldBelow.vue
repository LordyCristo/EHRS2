<template>
   <div class="flex flex-col">
       <span class="flex"><b>{{ label }}:</b></span>
       <span class="flex">{{ value }}</span>
   </div>
</template>
<script>
export default {
    props: {
        label: {
            type: [String, Number],
            required: true,
        },
        value: {
            type: [String, Number, null],
        },
    },
}
</script>
