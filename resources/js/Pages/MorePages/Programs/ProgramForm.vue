<template>
    <div class="flex items-center justify-between mb-3 gap-2">
        <Link :href="route('more.program.index')" class="text-gray-600 hover:text-gray-900 duration-300">
            <BackIcon class="w-6 h-auto hover:scale-[1.2] duration-300" />
        </Link>
        <h1 class=" text-center w-fit text-xl font-semibold">Register New Degree Program</h1>
        <Link :href="route('more.program.index')" class="text-gray-600 hover:text-gray-900 duration-300">
            <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
        </Link>
    </div>
    <form @submit.prevent="submit">
        <InputText v-model="form.name" label="Degree Program Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
        <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
        <InputText v-model="form.major" label="Major" :errorMsg="form.errors.major" @input="form.errors['major'] = null" />
        <InputText v-model="form.group" label="Group" :errorMsg="form.errors.group" @input="form.errors['group'] = null" />
        <SelectElement v-model="form.department_id" label="College" :options="departments" :errorMsg="form.errors.department_id" @input="form.errors['department_id'] = null" />
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
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
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
                abbr: null,
                major: null,
                group: null,
                department_id: null,
                is_active: null,
            }),
            statuses: [
                {id: 1, name: 'Active'},
                {id: 0, name: 'Inactive'},
            ],
            departments: [],
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
            this.$router.push({name:'more.program.index'});
            this.$router.back() // go back to the program index datatable.
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        },
        cancelForm(){
            this.form = useForm(this.data);
        },
        store() {
            axios.post(route('api.program.store'), this.form)
                .then(response => {
                    this.goBackToIndex();
                })
                .catch(error => this.printError(error));
        },
        update() {
            axios.put(route('api.program.update', this.data.id), this.form)
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
                axios.delete(route('api.program.destroy', this.data.id))
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
        this.departments = this.$page.props.departments.data;
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
        }
        else
            this.form.is_active = 1;
    }
};
</script>
