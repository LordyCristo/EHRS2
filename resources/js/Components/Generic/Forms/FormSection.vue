<template>
    <FormTitleHeader :link="route(props.indexLink)">
        <slot name="formTitle" />
    </FormTitleHeader>
    <div class="flex items-center justify-end">
        <div>
            <input type="checkbox" v-model="stayOnPage" @click="stayOnPageChange" class="rounded-full">
            <label for="stayOnPage" class="ml-2 text-sm text-gray-500">Stay on page</label>
        </div>
    </div>
    <form @submit.prevent="submit" id="printableFormContent">
        <slot name="formBody" />
        <div class="flex items-center justify-between mt-4">
            <template v-if="action === 'update'">
                <DeleteButton v-if="$page.props.auth.user.role === 1" @click="deleteForm">Delete</DeleteButton>
                <CancelButton @click="cancelForm">Cancel</CancelButton>
            </template>
            <ClearButton v-else @click="clearForm">Clear</ClearButton>
            <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</SubmitButton>
        </div>
    </form>
</template>

<script setup>
import {defineProps, onMounted, ref} from 'vue';
import FormTitleHeader from '@/Components/Generic/Forms/FormTitleHeader.vue';
import DeleteButton from '@/Components/Generic/Buttons/DeleteButton.vue';
import CancelButton from '@/Components/Generic/Buttons/CancelButton.vue';
import ClearButton from '@/Components/Generic/Buttons/ClearButton.vue';
import SubmitButton from '@/Components/Generic/Buttons/SubmitButton.vue';
import { pushNotification } from "@/Components/Generic/Modals/NotifBanner.vue";
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
    // save the value to local storage
    localStorage.setItem('stayOnPage', stayOnPage.value.toString());
};

onMounted(() => {
    // get the value from local storage
    stayOnPage.value = localStorage.getItem('stayOnPage') === 'true';
});

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
    props.form.errors = {};
};

const goBackToIndex = (response) => {
    if(typeof response != 'undefined')
        pushNotification(response.data.notification);
    else
        console.log(response);
    if (stayOnPage.value) {
        // reload the page to get the updated data using the same url but without loading the page.
        location.reload();
    } else {
        router.push({name: props.indexLink});
        router.back();
    }
};


const storeForm = () => {
    axios
        .post(props.storeLink, props.form)
        .then(res => {
            console.log(res.data.data);
            goBackToIndex(res);
        })
        .catch(printError);
};

const updateForm = () => {
    console.log(props.form);
    axios
        .put(props.updateLink, props.form)
        .then(res => {
            goBackToIndex(res);
        })
        .catch(printError);
    //props.form.put(props.updateLink);
};

const deleteForm = () => {
    if (confirm('Are you sure you want to delete this record?')) {
        stayOnPage.value = false;
        axios
            .delete(props.deleteLink)
            .then(res => {
                goBackToIndex(res);
            })
            .catch(console.error);
    }
};

const printError = (error) => {
    // error code for validation errors.
    if (typeof error.response != 'undefined' && error.response.status === 422) {
        props.form.errors = error.response.data.errors;
        pushNotification(error.response.data.notification);
        console.log(error.response.data.errors);
    }else {
        const notif = {
            'id': error.code,
            'show': true,
            'type': 'warning',
            'message': error.message,
        }
        console.log(error);
        pushNotification(notif);
    }

};
</script>
