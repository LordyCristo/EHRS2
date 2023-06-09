<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="radiology.request.index"
                 :update-link="data? route('api.radiology.request.update', data.id): null"
                 :store-link="route('api.radiology.request.store')"
                 :delete-link="data? route('api.radiology.request.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-4 gap-1">
                <InputTextAuto v-model.number="form.infirmary_id" label="Infirmary No." :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                <InputTextAuto v-model="form.or_no" label="OR No." :options="or_nos" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                <SelectElement v-model="form.ward" label="Ward" :options="WardType" :errorMsg="form.errors.ward" @input="form.errors['ward'] = null" />
            </div>
            <!--end of header form-->
            <!--urinalysis body form-->
            <div class="my-2 border-y py-5">
                <div class="grid grid-cols-1">
                    <InputTextArea v-model.number="form.rqst_for" label="X-ray Request For" :errorMsg="form.errors.rqst_for" @input="onFocusClearError('rqst_for')" />
                </div>
                <div class="grid grid-cols-1">
                    <InputTextArea v-model.number="form.history" label="History" :errorMsg="form.errors.history" @input="onFocusClearError('history')" />
                </div>
            </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-1">
                <SelectElement v-model="form.rqst_physician" label="Requesting Physician" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
            </div>
            <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of urinalysis footer form-->
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
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import {WardType} from "@/Legends/legends";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus } from "@/Legends/legends";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                infirmary_id: null,
                or_no: null,
                rqst_for: null,
                history: null,
                rqst_physician: null,
                ward: null,
                status: null,
            }),
            statuses: RecordStatus,
            data: null,
            physicians: [],
            or_nos: [],
            clients: [],
            formTitle: null,
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.clients = this.$page.props.clients.data;
        this.or_nos = this.$page.props.or_nos.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update X-ray Request';
        }
        else {
            this.formTitle = 'Create X-ray Request';
            this.form.infirmary_id = this.$page.props.last_client_id;
        }

    }
};
</script>

