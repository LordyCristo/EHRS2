<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="finance.payment.index"
                 :update-link="data? route('api.payment.update', data.id): null"
                 :store-link="route('api.payment.store')"
                 :delete-link="data? route('api.payment.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
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
        </template>
    </FormSection>
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
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
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
            formTitle: null,
        };
    },
    mounted() {
        this.clients = this.$page.props.clients.data;
        this.services = this.$page.props.services.data;

        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Form Details';
        }
        else {
            this.form.collector_id = this.$page.props.auth.user.id;
            this.formTitle = 'New Transaction Record';
        }
    }
};
</script>
