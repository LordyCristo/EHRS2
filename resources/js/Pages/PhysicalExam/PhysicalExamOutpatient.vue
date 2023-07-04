<template>
    <FormSection :data="data" :form="form" :action="action"
                                index-link="physicalexam.index"
                                :update-link="data? route('api.physicalexam.update', data.id): null"
                                :store-link="route('api.physicalexam.store')"
                                :delete-link="data? route('api.physicalexam.destroy', data.id): null"
>
    <template #formTitle>{{ formTitle }}</template>
    <template #formBody>
        <div class="grid grid-cols-1">
            <div class="grid grid-cols-2 border-b mb-2 pb-2">
                <div>
                    <InputTextAuto v-model="form.infirmary_id" label="Patient" :combinedNameId="true" :options="clients" required :errorMsg="form.errors.infirmary_id" @input="onFocusClearError('infirmary_id');" />
                    <div v-if="selected_client" class="flex justify-between gap-1">
                        <ViewField label="Infirmary ID" :value="selected_client.id" class="text-sm" />
                        <ViewField label="Sex" :value="selected_client.sex" class="text-sm capitalize" />
                        <ViewField label="Age" :value="selected_client.age" class="text-sm" />
                    </div>
                </div>
                <div class="grid grid-cols-3">
                    <DisplayValue label="Birthdate:" :value="selected_client?selected_client.birthdate:'none'" />
                    <DisplayValue label="Civil Status:" class="capitalize" :value="selected_client?selected_client.civil_status:'none'" />
                    <DisplayValue label="Religion:" class="capitalize" :value="selected_client?selected_client.religion:'none'" />
                </div>
            </div>
            <div>
                <table class="w-full">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>History & Clinical Findings</th>
                        <th>Treatment</th>
                        <th>Remarks</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                                        <tr v-for="item in form.rows">-->
                    <!--                                            <td><span class="text-gray-500 mx-1">{{ formattedDate(item.created_at) }}</span></td>-->
                    <!--                                            <td><span class="text-gray-500 mx-1 max-w-[20rem]">{{ item.history }}</span></td>-->
                    <!--                                            <td><span class="text-gray-500 mx-1">{{ item.treatment }}</span></td>-->
                    <!--                                            <td><span class="text-gray-500 mx-1">{{ item.remarks }}</span></td>-->
                    <!--                                        </tr>-->
                    <tr>
                        <td>
                            <div class="text-center">{{ formattedDate(form.created_at) }}</div>
                        </td>
                        <td>
                            <InputTextArea v-model="form.history" :showError="false" :errorMsg="form.errors.history" @input="onFocusClearError('history');" />
                        </td>
                        <td>
                            <InputTextArea v-model="form.treatment" :showError="false" :errorMsg="form.errors.treatment" @input="onFocusClearError('treatment');" />
                        </td>
                        <td class="flex gap-2 items-center">
                            <div class="w-full">
                                <InputTextArea v-model="form.remarks" :showError="false" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks');" />
                            </div>
                            <!--                                                <AddIcon class="w-6 h-6 bg-vsu-green text-white rounded-sm" @click="addRow" />-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col my-2">
                <label class="text-sm font-medium text-gray-800 mb-1">Upload Attachment Files</label>
                <input type="file" accept="image/jpeg" multiple @change=uploadImage>
            </div>
            {{ form }}
            <div class="grid grid-cols-4 gap-2">
                <template v-for="image in form.attachments">
                    <div class="relative">
                        <CloseIcon @click="removeImage(image)" class="absolute m-0.5 bg-vsu-olive bg-opacity-50 rounded-sm text-white w-6 top-0 right-0 cursor-pointer" tooltip="remove" />
                        <img :src="image"  :alt="image"/>
                    </div>
                </template>
            </div>
        </div>
    </template>
</FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import Select from '@/Components/Generic/Forms/SelectElement.vue';
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import DateTimePicker from "@/Components/Generic/Forms/DateTimePicker.vue";
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import {
    ArrivalCondition,
    BroughtBy,
    DepartCondition,
    Disposition,
    Religion,
    TemperatureLocation
} from "@/Legends/legends";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import DisplayValue from "@/Components/Generic/Forms/DisplayValue.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import PhysicalExam from "@/Pages/PhysicalExam.vue";
import AddIcon from "@/Components/Icons/AddIcon.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import { Sex, CivilStatus, YearLevel } from '@/Legends/legends';
import axios from "axios";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            sexes: Sex,
            civil_statuses: CivilStatus,
            year_levels: YearLevel,
            data: null,
            degree_programs: null,
            client_types: null,
            last_client_id: null,
            formTitle: null,
            form: useForm({
                created_at: null,
                infirmary_id: null,
                history: null,
                treatment: null,
                remarks: null,
                attachments: [],
                //rows: [],
                form_type: 'outpatient',
            }),
            clients: [],
            selected_client: null,
            physicians: [],
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        addRow() {
            if (this.form.history == null)
                this.form.errors.history = 'Required fields';
            if (this.form.treatment == null)
                this.form.errors.treatment = 'Required fields';
            if (this.form.remarks == null)
                this.form.errors.remarks = 'Required fields';

            if (this.form.history == null || this.form.treatment == null || this.form.remarks == null)
                return;

            this.form.rows.push({
                infirmary_id: this.form.infirmary_id,
                history: this.form.history,
                treatment: this.form.treatment,
                remarks: this.form.remarks,
                created_at: this.form.created_at,
            });
            this.form.history = null;
            this.form.treatment = null;
            this.form.remarks = null;
        },
        formattedDate(date){
            return new Date(date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        },
        uploadImage(e) {
            //can handle multiple files
            const files = e.target.files;
            if (!files.length) return;
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.readAsDataURL(files[i]);
                reader.onload = e => {
                    this.form.attachments.push(e.target.result);
                }
            }
        },
        removeImage(index) {
            this.form.attachments.splice(index, 1);
        },
    },
    watch:{
        'form.infirmary_id': function (val) {
            this.selected_client = this.clients.find(client => client.id === val);
            this.form.infirmary_id = val;
        },
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm({
                infirmary_id: this.data.infirmary_id,
                history: this.data.history,
                treatment: this.data.treatment,
                remarks: this.data.remarks,
                attachments: [],
                created_at: this.data.created_at,
                form_type: 'outpatient',
            });
            this.form.attachments = this.data.attachments.map(attachment => attachment.image);
            this.formTitle = 'Update Physical Exam';
        }else{
            this.formTitle = 'New Physical Exam Report';
        }
        this.clients = this.$page.props.clients.data;
        this.physicians = this.$page.props.physicians.data;
    }
};
</script>

