<template>
    <form @submit.prevent="submit">
        <SelectElement v-model="form.id" label="Service" :options="services" :errorMsg="form.errors.id" @input="form.errors['id'] = null" />
        <SelectElement v-model="form.client_type" label="Client Type" :options="client_types" :errorMsg="form.errors.client_type" @input="form.errors['client_type'] = null" />
        <InputText v-model="form.amount" label="Amount" type="number" :errorMsg="form.errors.amount" @input="form.errors['amount'] = null" />
        <div class="flex items-center justify-between mt-4">
            <template v-if="action === 'update'">
                <DeleteButton @click="deleteForm" >Delete</DeleteButton>
                <CancelButton  @click="cancelForm">Cancel</CancelButton>
            </template>
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
import DeleteButton from "@/Components/Generic/Buttons/DeleteButton.vue";
import Select from "@/Components/Generic/Headlessui/Select.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
export default {
    props: {
        errors: [Object, Function],
        action: String,
        client_types: Object,
        services: Object,
        data: {
            type: Object,
            required: false,
            default: [],
        },
    },
    data() {
        return {
            form: useForm({
                id: null,
                client_type: null,
                amount: null,
            }),
        };
    },
    methods: {
        submit() {
            if (this.action === 'store') {
                this.store();
            } else if (this.action === 'update') {
                this.update();
            } else {
                this.goBackToIndex();
            }
        },
        goBackToIndex(){
            this.$router.push({name:'finance.fee.index'});
            this.$router.back() // go back to the fee index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.fee.store'), this.form)
                .then(response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.fee.update', this.data.id), this.form)
                .then( response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        printError(error){
            if (error.response.status === 422) { // error code for validation errors.
                console.log('Validation errors:', error.response.data.errors);
                this.form.errors = error.response.data.errors;
            }
            else if (error.response.status === 500) { // error code for server errors.
                console.log('Server error:', error.response.data);
            }
            else if (error.response.status === 404) { // error code for not found data.
                console.log('Not found:', error.response.data);
            }
            else {
                console.log('Error:', error.response.data);
                console.log(this.$page.props.user);
            }
        },
        deleteForm(){
            if (confirm(`Are you sure you want to delete this record?`)) {
                axios.delete(route('api.fee.destroy', this.data.id))
                    .then( () => {
                        this.goBackToIndex();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
    },
    mounted() {
        if (this.action === 'update')
            this.form = useForm(this.data);
    }
};
</script>
