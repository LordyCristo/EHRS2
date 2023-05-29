<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="finance.fee.index"
                 :update-link="data? route('api.fee.update', data.id): null"
                 :store-link="route('api.fee.store')"
                 :delete-link="data? route('api.fee.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <SelectElement v-model="form.service_id" label="Service" :options="services" :errorMsg="form.errors.service_id" @input="form.errors['service_id'] = null" />
            <SelectElement v-model="form.client_type" label="Client Type" :options="client_types" :errorMsg="form.errors.client_type" @input="form.errors['client_type'] = null" />
            <InputText v-model="form.amount" label="Amount" type="number" :errorMsg="form.errors.amount" @input="form.errors['amount'] = null" />
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                service_id: null,
                client_type: null,
                amount: null,
            }),
            client_types: null,
            services: null,
            data: null,
            formTitle: null,
        };
    },
    mounted() {
        this.client_types = this.$page.props.client_types.data;
        this.services = this.$page.props.services.data;

        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Fee Details';
        }
        else{
            this.formTitle = 'Register New Fee';
        }
    }
};
</script>
