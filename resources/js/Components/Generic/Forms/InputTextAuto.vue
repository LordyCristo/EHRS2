<template>
    <InputField :name="name" :errorMsg="errorMsg" :label="label" :required="required">
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
                :class="errorMsg ? 'border-red-300' : 'border-gray-300'"
                @keydown.delete="!query.length?$emit('update:modelValue', null):''"
                @input="filterOptions"
            />
            <div v-if="show" class="absolute bg-white z-50 w-fit mt-2 rounded-md shadow-md border p-1 max-h-72 overflow-y-scroll">
                <div v-if="filteredOptions.length === 0" class="py-0.5 px-4 text-gray-500">
                    No record found
                </div>
                <div v-for="opt in filteredOptions" @focusout="show = false">
                    <div>
                        <div
                            class="py-0.5 px-4 cursor-pointer hover:bg-vsu-olive hover:text-white rounded-md"
                            @click="selectOption(opt); $emit('update:modelValue', opt.id);"
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
import { ref, computed, defineProps, watch } from 'vue';
import InputField from '@/Components/Generic/Forms/InputField.vue';

const props = defineProps({
    modelValue: [String, Number],
    errorMsg: [String, Array],
    id: String,
    name: String,
    label: String,
    required: Boolean,
    options: [Array, Function],
    class: String,
    step: Number,
    autofocus: Boolean,
    type: {
        type: String,
        default: 'text',
    },
});

const selected = ref('');
const query = ref('');
const show = ref(false);

const filteredOptions = computed(() =>
    query.value === ''
        ? props.options
        : props.options.filter((option) =>
            option.name
                .toString() // Convert the numeric value to string for comparison
                .toLowerCase()
                .includes(query.value)
        )
);

const filterOptions = () => {
    show.value = query.value.length > 0;
    query.value = query.value.trim();
};

const selectOption = (option) => {
    selected.value = option.name;
    query.value = option.name;
   //this.$emit('update:modelValue', option.id);
    show.value = false;
};

watch(() => props.modelValue, (newValue) => {
    query.value =
        props.options.find((option) => option.id === newValue)?.name ?? '';
});
</script>
