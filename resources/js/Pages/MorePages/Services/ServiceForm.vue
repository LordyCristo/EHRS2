<template>
    <form @submit.prevent="submit">
        <InputText v-model="form.name" label="Service Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
        <InputText v-model="form.description" label="Description" :errorMsg="form.errors.description" @input="form.errors['description'] = null" />
        <InputText v-model="form.schedule" label="Schedule" :errorMsg="form.errors.schedule" @input="form.errors['schedule'] = null" />
        <InputText v-model="form.section_name" label="Section Name" :errorMsg="form.errors.section_name" @input="form.errors['section_name'] = null" />
        <InputText v-model="form.room_no" label="Room No" :errorMsg="form.errors.room_no" @input="form.errors['room_no'] = null" />
        <RadioButton v-model="form.is_active" label="Status" :options="statuses" :errorMsg="form.errors.is_active" @input="form.errors['is_active'] = null" />
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
                name: null,
                description: null,
                schedule: null,
                section_name: null,
                room_no: null,
                is_active: null,
            }),
            statuses: [
                {id: 1, name: 'Active'},
                {id: 0, name: 'Inactive'},
            ],
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
            this.$router.push({name:'more.service.index'});
            this.$router.back() // go back to the service index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.service.store'), this.form)
                .then(response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.service.update', this.data.id), this.form)
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
                axios.delete(route('api.service.destroy', this.data.id))
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
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
        }
        else
            this.form.is_active = 1;
    }
};
</script>
