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
                    <div class="grid grid-cols-2">
                        <DisplayValue label="Birthdate:" :value="selected_client?selected_client.birthdate:'none'" />
                        <DisplayValue label="Civil Status:" :value="selected_client?selected_client.civil_status:'none'" />
                    </div>
                </div>
                <div class="grid grid-cols-4">
                    <InputText v-model.number="form.height" label="Height (cm)" required type="number" step="0.1" :errorMsg="form.errors.height" @input="onFocusClearError('height');" />
                    <InputText v-model.number="form.weight" label="Weight (kg)" required type="number" step="0.1" :errorMsg="form.errors.weight" @input="onFocusClearError('weight');" />
                    <InputText v-model="form.blood_pressure" label="Blood Pressure" required :errorMsg="form.errors.blood_pressure" @input="onFocusClearError('blood_pressure');" />
                    <InputText v-model="form.pulse" label="Pulse Rate" required :errorMsg="form.errors.pulse" @input="onFocusClearError('pulse');" />
                </div>
                <div class="grid grid-cols-4">
                    <InputTextArea v-model="form.prev_illns_oprtn" label="Previous Illness/Operation" :errorMsg="form.errors.prev_illns_oprtn" @input="onFocusClearError('prev_illns_oprtn');" />
                    <InputTextArea v-model="form.immnztn_vccntn" label="Immunization/Vaccination" :errorMsg="form.errors.immnztn_vccntn" @input="onFocusClearError('immnztn_vccntn');" />
                    <InputTextArea v-model="form.head_neck" label="Head and Neck" :errorMsg="form.errors.head_neck" @input="onFocusClearError('head_neck');" />
                    <InputTextArea v-model="form.scalp_face" label="Scalp and Face" :errorMsg="form.errors.scalp_face" @input="onFocusClearError('scalp_face');" />
                    <InputTextArea v-model="form.neck_thyroid" label="Neck and Thyroid" :errorMsg="form.errors.neck_thyroid" @input="onFocusClearError('neck_thyroid');" />
                    <InputTextArea v-model="form.lymph_glands" label="Lymph Glands" :errorMsg="form.errors.lymph_glands" @input="onFocusClearError('lymph_glands');" />
                    <InputTextArea v-model="form.vision_with_glasses" label="Vision with Glasses" :errorMsg="form.errors.vision_with_glasses" @input="onFocusClearError('vision_with_glasses');" />
                    <InputTextArea v-model="form.vision_without_glasses" label="Vision without Glasses" :errorMsg="form.errors.vision_without_glasses" @input="onFocusClearError('vision_without_glasses');" />
                    <InputTextArea v-model="form.mouth_throat_tonsils" label="Tonsils" :errorMsg="form.errors.mouth_throat_tonsils" @input="onFocusClearError('mouth_throat_tonsils');" />
                    <InputTextArea v-model="form.mouth_throat_teeth" label="Teeth" :errorMsg="form.errors.mouth_throat_teeth" @input="onFocusClearError('mouth_throat_teeth');" />
                    <InputTextArea v-model="form.heart" label="Heart" :errorMsg="form.errors.heart" @input="onFocusClearError('heart');" />
                    <InputTextArea v-model="form.lung" label="Lungs" :errorMsg="form.errors.lung" @input="onFocusClearError('lung');" />
                    <InputTextArea v-model="form.abdomen_tenderness" label="Abdomen tenderness" :errorMsg="form.errors.abdomen_tenderness" @input="onFocusClearError('abdomen_tenderness');" />
                    <InputTextArea v-model="form.abdomen_mass" label="Abdominal masses" :errorMsg="form.errors.abdomen_mass" @input="onFocusClearError('abdomen_mass');" />
                    <InputTextArea v-model="form.abdomen_scars" label="Abdomen scars" :errorMsg="form.errors.abdomen_scars" @input="onFocusClearError('abdomen_scars');" />
                    <InputTextArea v-model="form.abdomen_rep_organ" label="Reproductive organs" :errorMsg="form.errors.abdomen_rep_organ" @input="onFocusClearError('abdomen_rep_organ');" />
                    <InputTextArea v-model="form.spine_extrts_deformities" label="Spine and Extremities: Deformitities" :errorMsg="form.errors.spine_extrts_deformities" @input="onFocusClearError('spine_extrts_deformities');" />
                    <InputTextArea v-model="form.spine_extrts_varicosities" label="Spine and Extremities: Varicosities" :errorMsg="form.errors.spine_extrts_varicosities" @input="onFocusClearError('spine_extrts_varicosities');" />
                    <InputTextArea v-model="form.spine_extrts_feet" label="Spine and Extremities: Feet" :errorMsg="form.errors.spine_extrts_feet" @input="onFocusClearError('spine_extrts_feet');" />
                    <InputTextArea v-model="form.skin_diseases" label="Skin Diseases" :errorMsg="form.errors.skin_diseases" @input="onFocusClearError('skin_diseases');" />
                </div>
                <InputTextArea v-model="form.remarks" label="Remarks" :errorMsg="form.errors.remarks" @input="onFocusClearError('remarks');" />
                <div>
                    <InputTextAuto v-model="form.examiner" label="Examiner" :errorMsg="form.errors.examiner" :options="physicians" @input="onFocusClearError('examiner');" />
                </div>
                <div class="flex flex-col my-2">
                    <label class="text-sm font-medium text-gray-800 mb-1">Upload Attachement Files</label>
                    <input type="file" accept="image/jpeg" multiple @change=uploadImage>
                </div>
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
                infirmary_id: null,
                examiner: null,
                weight: null,
                height: null,
                blood_pressure: null,
                pulse: null,
                prev_illns_oprtn: null,
                immnztn_vccntn: null,
                head_neck: null,
                scalp_face: null,
                neck_thyroid: null,
                lymph_glands: null,
                vision_with_glasses: null,
                vision_without_glasses: null,
                mouth_throat_tonsils: null,
                mouth_throat_teeth: null,
                heart: null,
                lung: null,
                abdomen_tenderness: null,
                abdomen_mass: null,
                abdomen_scars: null,
                abdomen_rep_organ: null,
                spine_extrts_deformities: null,
                spine_extrts_varicosities: null,
                spine_extrts_feet: null,
                skin_diseases: null,
                attachments: [],
                remarks: null,
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
        }
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.form.attachments = this.data.attachments.map(attachment => attachment.image);
            this.formTitle = 'Update Physical Exam';
        }else{
            this.formTitle = 'New Physical Exam Report';;
        }
        this.clients = this.$page.props.clients.data;
        this.physicians = this.$page.props.physicians.data;
    }
};
</script>

