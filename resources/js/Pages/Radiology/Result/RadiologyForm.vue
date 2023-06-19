<template>
    <FormSection :data="data" :form="form" :action="action"
                 ref="form"
                 index-link="radiology.result.index"
                 :update-link="data? route('api.radiology.result.update', data.id): null"
                 :store-link="route('api.radiology.result.store')"
                 :delete-link="data? route('api.radiology.result.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div>
                <InputTextAuto v-model="form.rqst_id" required label="Patient" :options="xray_reqs" :errorMsg="form.errors.rqst_id" @input="form.errors['rqst_id'] = null" />
            </div>
            <div v-if="form.rqst_id" class="grid grid-cols-2 p-1 text-sm text-gray-500">
                <div class="flex gap-2 w-fit">
                    <b>Request ID:</b>
                    <span class="uppercase">{{rqst_details.id}}</span>
                </div>
                <div class="flex gap-2 w-fit">
                    <b>Infirmary ID:</b>
                    <span class="uppercase">{{rqst_details.infirmary_id}}</span>
                </div>
                <div class="flex gap-2 w-fit">
                    <b>Sex:</b>
                    <span class="uppercase">{{rqst_details.sex}}</span>
                </div>
                <div class="flex gap-2 w-fit">
                    <b>Age:</b>
                    <span class="uppercase">{{rqst_details.age}}</span>
                </div>
            </div>
            <!--end of header form-->

            <!--urinalysis body form-->
            <div class="my-2 border-y py-5">
                <div class="grid grid-cols-1 gap-1">
                    <InputTextAuto v-model="form.procedure" required label="Prodecure" :options="procedures" :errorMsg="form.errors.procedure" @input="form.errors['procedure'] = null" />
                </div>
                <div class="flex flex-col my-2">
                    <label class="text-sm font-medium text-gray-800 mb-1">Upload X-ray Image</label>
                    <input type="file" accept="image/jpeg" @change=uploadImage>
                </div>
                <div v-if="form.image" class="flex justify-center my-2">
                    <img :src="form.image" class="uploading-image max-w-xl max-h-60"  alt="sass"/>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <InputTextArea v-model="form.radiographic_findings" required label="Radiolographic Findings" :errorMsg="form.errors.radiographic_findings" @input="form.errors['radiographic_findings'] = null" />
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <InputTextArea v-model="form.impression" required label="Impression" :errorMsg="form.errors.impression" @input="form.errors['impression'] = null" />
                </div>
            </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-2">
                <SelectElement v-model="form.rad_tech_id" required label="Radiologic Technologist" :options="physicians" :errorMsg="form.errors.rad_tech_id" @input="form.errors['rad_tech_id'] = null" />
                <SelectElement v-model="form.radiologist_id" required label="Radiologist" :options="physicians" :errorMsg="form.errors.radiologist_id" @input="form.errors['radiologist_id'] = null" />
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
                image: null,
            }),
            statuses: RecordStatus,
            data: null,
            physicians: [],
            or_nos: [],
            xray_reqs: [],
            clients: [],
            procedures: [],
            formTitle: null,
        };
    },
    computed: {
        // rqst id age and sex
        rqst_details() {
            return this.xray_reqs[this.xray_reqs.findIndex(x => x.id === this.form.rqst_id)];
        },
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        uploadImage(e){
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e =>{
                this.previewImage = e.target.result;
                this.form.image = this.previewImage;
            };
        }
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.xray_reqs = this.$page.props.xray_reqs.data;
        this.procedures = this.$page.props.xray_procedures.data;
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

