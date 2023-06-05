<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label">
        <div>
            <input
                v-model="query"
                :id="id"
                :name="name"
                ref="input"
                :step="step"
                :type="type"
                :autofocus="autofocus"
                class="sm:p-2 p-1 w-full border overflow-ellipsis rounded-md shadow-sm focus:border-vsu-olive focus:ring focus:ring-indigo-200 focus:ring-opacity-50 duration-300"
                :class="errorMsg?'border-red-300':'border-gray-300'"
                @focus="show = true"
                @input="filterOptions"
            />
            <div v-if="show" class="absolute bg-white z-50 w-fit mt-2 rounded-md shadow-md border p-1 max-h-72 overflow-y-scroll">
                <div v-for="opt in options" @focusout="show = false">
                    <div v-if="opt.name.toString().toLowerCase().includes(query.toLowerCase())">
                        <div
                            class="py-0.5 px-4 cursor-pointer hover:bg-vsu-olive hover:text-white rounded-md"
                            @click="selected = opt.name; query = opt.name; $emit('update:modelValue', opt.id); show = false"
                        >
                            {{ opt.name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </InputField>
</template>

<script setup>
import {ref, computed, defineProps, watch} from 'vue';
import InputField from "@/Components/Generic/Forms/InputField.vue";

const props = defineProps({
    modelValue: [String, Number],
    errorMsg: [String, Array],
    id: String,
    name: String,
    label: String,
    options: [Array, Function],
    class: String,
    step: Number,
    autofocus: Boolean,
    type: {
        type: String,
        default: 'text',
    },
});

let selected = ref('');
let query = ref('');
let show = ref(false);

let filteredOptions = computed(() =>
    query.value === ''
        ? props.options
        : props.options.filter((option) =>
            option.name
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);

const filterOptions = (event) => {
    show.value = query.value.length > 0;
    query.value = query.value.trim();
};

watch(() => props.modelValue, (newValue) => {
    query.value = props.options.find((option) => option.id === newValue)?.name ?? '';
});
</script>
