<template>
    <span style="display: flex; align-items: center; gap: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>{{ label }}:</b>{{ value }}</span>
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
