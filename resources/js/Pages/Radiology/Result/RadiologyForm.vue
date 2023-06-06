<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="radiology.result.index"
                 :update-link="data? route('api.radiology.result.update', data.id): null"
                 :store-link="route('api.radiology.result.store')"
                 :delete-link="data? route('api.radiology.result.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-3 gap-1">
                <InputTextAuto v-model="form.rqst_id" label="X-ray Request ID" @change="changeRqst" :options="xray_reqs" :errorMsg="form.errors.rqst_id" @input="form.errors['rqst_id'] = null" />
                <div>

                </div>
            </div>
            <!--end of header form-->
            <!--urinalysis body form-->
            <div class="my-2 border-y py-5">
                <div class="grid grid-cols-1 gap-1">
                    <InputText v-model="form.procedure" label="Prodecure" :errorMsg="form.errors.procedure" @input="form.errors['procedure'] = null" />
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <InputText v-model="form.radiographic_findings" label="Radiolographic Findings" :errorMsg="form.errors.radiographic_findings" @input="form.errors['radiographic_findings'] = null" />
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <InputTextArea v-model="form.impression" label="Impression" :errorMsg="form.errors.impression" @input="form.errors['impression'] = null" />
                </div>
            </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-2">
                <SelectElement v-model="form.rad_tech_id" label="Radiologic Technologist" :options="physicians" :errorMsg="form.errors.rad_tech_id" @input="form.errors['rad_tech_id'] = null" />
                <SelectElement v-model="form.radiologist_id" label="Radiologist" :options="physicians" :errorMsg="form.errors.radiologist_id" @input="form.errors['radiologist_id'] = null" />
            </div>
            <!--end of urinalysis footer form-->
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
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
                // radiology
                rqst_id: null,
                procedure: null,
                impression: null,
                radiographic_findings: null,
                rad_tech_id: null,
                radiologist_id: null,
            }),
            statuses: RecordStatus,
            data: null,
            physicians: [],
            or_nos: [],
            xray_reqs: [],
            clients: [],
            formTitle: null,
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        changeRqst(){
            const select = this.xray_reqs.find(x => x.id === this.form.rqst_id);
            console.log(select.value);
        }
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.xray_reqs = this.$page.props.xray_reqs.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data.xray;
            this.form = useForm(this.data);
            this.formTitle = 'Update X-ray Result';
        }
        else {
            this.formTitle = 'Create X-ray Result';
            this.form.infirmary_id = this.$page.props.last_client_id;
        }

    },
};
</script>

