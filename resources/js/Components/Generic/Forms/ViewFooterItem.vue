<template>
    <div style="display: flex; flex-direction: column; text-align: center;">
        <span style="text-decoration-line: underline; font-weight: bold; text-transform: uppercase;"><slot name="name" /></span>
        <span>License No. <slot name="license"/></span>
        <span><slot name="specialization" /></span>
    </div>
</template>
