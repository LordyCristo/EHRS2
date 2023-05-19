<template>
    <form @submit.prevent="submit">
        <InputText v-model="form.name" label="College Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
        <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
        <RadioButton v-model="form.status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="form.errors['status'] = null" />
        <div class="flex items-center justify-between mt-4">
            <CancelButton v-if="action === 'update'" @click="cancelForm">Cancel</CancelButton>
            <ClearButton v-else @click="clearForm">Clear</ClearButton>
            <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
        </div>
    </form>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import CancelButton from "@/Components/Generic/Buttons/CancelButton.vue";
import ClearButton from "@/Components/Generic/Buttons/ClearButton.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";
export default {
    props: {
        action: String,
        data: {
            type: Object,
            required: false,
            default: [],
        },
    },
    data() {
        return {
            form: useForm({
                name: null,
                abbr: null,
                status: null,
            }),
            statuses: [
                {id: 1, name: 'Active'},
                {id: 0, name: 'Inactive'},
            ],
        };
    },
    methods: {
        submit() {
            this.form.post(route('api.college.store'), {
                onSuccess: () => {
                    this.clearForm();
                },
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
    },
};
</script>
