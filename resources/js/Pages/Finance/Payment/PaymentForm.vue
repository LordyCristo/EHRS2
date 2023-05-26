<template>
    <h1 class="flex justify-center text-sm bg-gray-200 py-1 my-1 rounded-sm"><span class="font-semibold">Official Receipt No.:</span> {{ this.$page.props.last_payment_id+1 }}</h1>
    <form @submit.prevent="submit">
        <InputText v-model="form.payor_name" label="Payor Name" :errorMsg="form.errors.payor_name" @input="form.errors['payor_name'] = null" />
        <div class="grid grid-cols-2">
            <InputText v-model="form.payor_email" label="Payor Email" :errorMsg="form.errors.payor_email" @input="form.errors['payor_email'] = null" />
            <InputText v-model="form.payor_mobile" label="Payor Mobile No." :errorMsg="form.errors.payor_mobile" @input="form.errors['payor_mobile'] = null" />
            <SelectElement v-model="form.client_id" label="Client" :options="clients" :errorMsg="form.errors.client_id" @input="form.errors['client_id'] = null" />
            <SelectElement v-model="form.service_id" label="Service" :options="services" :errorMsg="form.errors.service_id" @input="form.errors['service_id'] = null" />
            <InputText v-model="form.amount" label="Amount" type="number" :errorMsg="form.errors.amount" @input="form.errors['amount'] = null" />
            <InputText v-model="form.collector_id" label="Collector ID" type="number" :errorMsg="form.errors.collector_id" @input="form.errors['collector_id'] = null" />
        </div>
        <InputText v-model="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="form.errors['remarks'] = null" />
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
        action: String,
    },
    data() {
        return {
            form: useForm({
                payor_name: null,
                payor_email: null,
                payor_mobile: null,
                client_id: null,
                service_id: null,
                collector_id: null,
                amount: null,
                remarks: null,
            }),
            clients: null,
            services: null,
            data: null,
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
            this.$router.push({name:'finance.payment.index'});
            this.$router.back() // go back to the payment index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.payment.store'), this.form)
                .then(response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.payment.update', this.$page.props.data.id), this.form)
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
                axios.delete(route('api.payemnt.destroy', this.$page.props.data.id))
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
            this.form = useForm(this.$page.props.data);
        else
            this.form.collector_id = this.$page.props.auth.user.id;

        this.clients = this.$page.props.clients.data;
        this.services = this.$page.props.services.data;
    }
};
</script>
