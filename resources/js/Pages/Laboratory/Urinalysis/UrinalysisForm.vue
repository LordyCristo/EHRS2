<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="laboratory.urinalysis.index"
                 :update-link="data? route('api.urinalysis.update', data.id): null"
                 :store-link="route('api.urinalysis.store')"
                 :delete-link="data? route('api.urinalysis.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-4 gap-1">
                <DisplayValue label="Request No." :value="form.rqst_id?form.rqst_id:'none'" />
                <DisplayValue label="Date Requested" :value="formatDate(new Date())" />
                <InputTextAuto v-model="form.or_no" label="OR No." :options="or_nos" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                <SelectElement v-model="form.ward" label="Ward" :options="WardType" :errorMsg="form.errors.ward" :required="true" @input="form.errors['ward'] = null" />
            </div>
            <div class="flex flex-col">
<!--                <DisplayValue label="Infirmary ID" :value="form.infirmary_id?form.infirmary_id:'none'" />-->
                <div class="w-full">
                    <InputTextAuto v-model.number="form.infirmary_id" :combinedNameId="true" autofocus label="Patient" :required="true" :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                </div>
                <div v-if="selectedClient" class="flex justify-between gap-1">
                    <ViewField label="Infirmary ID" :value="selectedClient.id" class="text-sm" />
                    <ViewField label="Sex" :value="selectedClient.sex" class="text-sm capitalize" />
                    <ViewField label="Age" :value="selectedClient.age" class="text-sm" />
                </div>
            </div>
            <!--end of header form-->
            <!--urinalysis body form-->
           <div class="my-2 border-y py-5">
               <div class="grid grid-cols-4 gap-1">
                   <InputText v-model="form.color" label="Color" :errorMsg="form.errors.color" :required="true" @input="onFocusClearError('color')" />
                   <SelectElement v-model="form.clarity" label="Clarity" :options="Lab_Group_5" :errorMsg="form.errors.clarity" :required="true" @input="onFocusClearError('clarity')" />
                   <InputText v-model="form.ph" label="pH" type="number" :step="0.1" :errorMsg="form.errors.ph" :required="true" @input="onFocusClearError('ph')" />
                   <InputText v-model="form.specific_gravity" type="number" :step="0.1" :required="true" label="Specific Gravity" :errorMsg="form.errors.specific_gravity" @input="onFocusClearError('specific_gravity')" />
                   <SelectElement v-model="form.albumin" :options="Lab_Group_1" label="Albumin" :errorMsg="form.errors.albumin" :required="true" @input="onFocusClearError('albumin')" />
                   <SelectElement v-model="form.glucose" :options="Lab_Group_1"  label="Glucose" :errorMsg="form.errors.glucose" :required="true" @input="onFocusClearError('glucose')" />
                   <SelectElement v-model="form.blood" :options="Lab_Group_1"  label="Blood" :errorMsg="form.errors.blood" :required="true" @input="onFocusClearError('blood')" />
                   <SelectElement v-model="form.leukocytes" :options="Lab_Group_1"  label="Leukocytes" :errorMsg="form.errors.leukocytes" :required="true" @input="onFocusClearError('leukocytes')" />
                   <SelectElement v-model="form.nitrite" :options="Lab_Group_2" label="Nitrite" :errorMsg="form.errors.nitrite" :required="true" @input="onFocusClearError('nitrite')" />
                   <SelectElement v-model="form.bilirubin" :options="Lab_Group_1" label="Bilirubin" :errorMsg="form.errors.bilirubin" :required="true" @input="onFocusClearError('bilirubin')" />
                   <SelectElement v-model="form.urobilinogen" :options="Lab_Group_3" label="Urobilinogen" :errorMsg="form.errors.urobilinogen" :required="true" @input="onFocusClearError('urobilinogen')" />
                   <SelectElement v-model="form.ketones" label="Ketones" :options="Lab_Group_1" :errorMsg="form.errors.ketones" :required="true" @input="onFocusClearError('ketones')" />
                   <SelectElement v-model="form.wbc" label="WBC" :options="Lab_Group_4" :errorMsg="form.errors.wbc" :required="true" @input="onFocusClearError('wbc')" />
                   <SelectElement v-model="form.rbc" label="RBC" :options="Lab_Group_4" :errorMsg="form.errors.rbc" :required="true" @input="onFocusClearError('rbc')" />
                   <SelectElement v-model="form.epithelial_cells" :options="Lab_Group_1" label="Epithelial Cells" :required="true" :errorMsg="form.errors.epithelial_cells" @input="onFocusClearError('epithelial_cells')" />
                   <SelectElement v-model="form.bacteria" label="Bacteria" :options="Lab_Group_1" :errorMsg="form.errors.bacteria" :required="true" @input="onFocusClearError('bacteria')" />
                   <SelectElement v-model="form.amorphous_urates" :options="Lab_Group_1" label="Urates" :required="true" :errorMsg="form.errors.amorphous_urates" @input="onFocusClearError('amorphous_urates')" />
                   <SelectElement v-model="form.amorphous_phosphates" :options="Lab_Group_1" label="Phosphates" :required="true" :errorMsg="form.errors.amorphous_phosphates" @input="onFocusClearError('amorphous_phosphates')" />
                   <SelectElement v-model="form.mucous_threads" :options="Lab_Group_1" label="Mucus Threads" :required="true" :errorMsg="form.errors.mucous_threads" @input="onFocusClearError('mucous_threads')" />
               </div>
               <div class="grid grid-cols-1">
                   <InputText v-model="form.crystals" label="Crystals" :errorMsg="form.errors.crystals" @input="onFocusClearError('crystals')" />
                   <InputText v-model="form.cast" label="Cast" :errorMsg="form.errors.cast" @input="onFocusClearError('cast')" />
                   <InputTextArea v-model.number="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks')" />
               </div>
           </div>
            <!--end of urinalysis body form-->
            <!--urinalysis footer form-->
            <div class="grid grid-cols-3">
                <SelectElement v-model="form.rqst_physician" label="Requesting Physician" :required="true" :options="physicians" :errorMsg="form.errors.rqst_physician" @input="form.errors['rqst_physician'] = null" />
                <SelectElement v-model="form.medical_technologist" label="Medical Technologist" :required="true" :options="physicians" :errorMsg="form.errors.medical_technologist" @input="form.errors['medical_technologist'] = null" />
                <SelectElement v-model="form.pathologist" label="Pathologist" :options="physicians" :required="true" :errorMsg="form.errors.pathologist" @input="form.errors['pathologist'] = null" />
            </div>
            <div class="grid grid-cols-1">
                <RadioButton v-if="false" v-model="form.is_out_patient" required label="In/Out Patient" :options="InOutPatient" :errorMsg="form.errors.is_out_patient" @input="form.errors['is_out_patient'] = null" />
                <RadioButton v-model="form.status" id="status" label="Status" :options="statuses" :required="true" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            </div>
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
import {
    InOutPatient,
    Lab_Group_1,
    Lab_Group_2,
    Lab_Group_3,
    Lab_Group_4,
    Lab_Group_5,
    WardType
} from "@/Legends/legends";
import DisplayValue from "@/Components/Generic/Forms/DisplayValue.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
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
                // urinalysis record
                infirmary_id: null,
                rqst_id: null,
                rqst_physician: 2,
                medical_technologist: 3,
                pathologist: 4,
                ward: 'opd',
                or_no: null,
                status: 'pending',
                is_out_patient: 1,
                //urinalysis
                color: 'red',
                clarity: 'turbid',
                ph: '7.9',
                specific_gravity: 14,
                albumin: null,
                glucose: null,
                blood: null,
                leukocytes: null,
                nitrite: null,
                bilirubin: null,
                urobilinogen: null,
                ketones: null,
                wbc: null,
                rbc: null,
                epithelial_cells: null,
                bacteria: null,
                amorphous_urates: null,
                amorphous_phosphates: null,
                mucous_threads: null,
                crystals: null,
                cast: null,
                remarks: null,
            }),
            statuses: RecordStatus,
            bloodTypes: BloodType,
            data: null,
            selectedClient: null,
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
        formatDate(date) {
            // format date to yyyy-mm-dd
            return date.toLocaleDateString();
        },
    },
    watch:{
        'form.infirmary_id': function (val) {
            const temp = this.clients.find(client => client.id === val);
            if (temp) {
                this.form.rqst_id = temp.rqst_id;
                this.selectedClient = temp;
            }
            else {
                this.form.rqst_id = null;
                this.selectedClient = null;
            }
        },
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.or_nos = this.$page.props.or_nos.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Urinalysis Record';
            this.clients = this.$page.props.clients.data;
        }
        else {
            this.clients = this.$page.props.requests.data;
            this.formTitle = 'Create Urinalysis Record';
            this.form.infirmary_id = this.$page.props.last_client_id;
            // set all required field to negative as default
            this.form.albumin = 'negative';
            this.form.glucose = 'negative';
            this.form.blood = 'negative';
            this.form.leukocytes = 'negative';
            this.form.nitrite = 'negative';
            this.form.bilirubin = 'negative';
            this.form.urobilinogen = 'negative';
            this.form.ketones = 'negative';
            this.form.wbc = '0-2';
            this.form.rbc = '0-2';
            this.form.epithelial_cells = 'negative';
            this.form.bacteria = 'negative';
            this.form.amorphous_urates = 'negative';
            this.form.amorphous_phosphates = 'negative';
            this.form.mucous_threads = 'negative';
        }

    }
};
</script>

