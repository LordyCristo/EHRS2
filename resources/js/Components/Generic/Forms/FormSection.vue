<template>
    <FormTitleHeader :link="route(props.indexLink)">
        <slot name="formTitle" />
    </FormTitleHeader>
    <div class="flex items-center justify-end">
        <input type="checkbox" v-model="stayOnPage" @click="stayOnPageChange" class="rounded-full">
        <label for="stayOnPage" class="ml-2 text-sm text-gray-500">Stay on page</label>
    </div>
    <form @submit.prevent="submit">
        <slot name="formBody" />
        <div class="flex items-center justify-between mt-4">
            <template v-if="action === 'update'">
                <DeleteButton @click="deleteForm">Delete</DeleteButton>
                <CancelButton @click="cancelForm">Cancel</CancelButton>
            </template>
            <ClearButton v-else @click="clearForm">Clear</ClearButton>
            <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
        </div>
    </form>
</template>

<script setup>
import {defineProps, ref} from 'vue';
import FormTitleHeader from '@/Components/Generic/Forms/FormTitleHeader.vue';
import DeleteButton from '@/Components/Generic/Buttons/DeleteButton.vue';
import CancelButton from '@/Components/Generic/Buttons/CancelButton.vue';
import ClearButton from '@/Components/Generic/Buttons/ClearButton.vue';
import SubmitButton from '@/Components/Generic/Buttons/SubmitButton.vue';
import axios from 'axios';
import { router } from '@/router';

const props = defineProps({
    indexLink: {
        type: String,
        required: true,
    },
    updateLink: String,
    storeLink: String,
    deleteLink: String,
    action: {
        type: String,
        required: true,
    },
    data: Object,
    form: Object,
});

const stayOnPage = ref(false);
const stayOnPageChange = () => {
    stayOnPage.value = !stayOnPage.value;
};
const submit = () => {
    if (props.action === 'store') {
        storeForm();
    } else if (props.action === 'update') {
        updateForm();
    } else {
        goBackToIndex();
    }
};

const cancelForm = () => {
    props.form.reset();
};

const clearForm = () => {
    props.form.reset();
};

const goBackToIndex = () => {
    if (stayOnPage.value) {
        //props.action.value = 'create';
        clearForm();
    }else {
        router.push({name: props.indexLink});
        router.back();
    }
};

const storeForm = () => {
    axios
        .post(props.storeLink, props.form)
        .then(() => {
            goBackToIndex();
        })
        .catch(printError);
};

const updateForm = () => {
    axios
        .put(props.updateLink, props.form)
        .then(() => {
            goBackToIndex();
        })
        .catch(printError);
};

const deleteForm = () => {
    if (confirm('Are you sure you want to delete this record?')) {
        stayOnPage.value = false;
        axios
            .delete(props.deleteLink)
            .then(() => {
                goBackToIndex();
            })
            .catch(console.error);
    }
};

const printError = (error) => {
    if (typeof error.response === 'undefined'){
        console.log(error);
    }
    else if (error.response.status === 422) { // error code for validation errors.
        console.log('Validation errors:', error.response.data.errors);
        props.form.errors = error.response.data.errors;
    }
    else if (error.response.status === 500) { // error code for server errors.
        console.log('Server error:', error.response.data);
    }
    else if (error.response.status === 404) { // error code for not found data.
        console.log('Not found:', error.response.data);
    }
    else {
        console.log('Error:', error.response.data);
    }
};
</script>
