<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="dental.treatment.index"
                 :update-link="data? route('api.dental.treatment.update', data.id): null"
                 :store-link="route('api.dental.treatment.store')"
                 :delete-link="data? route('api.dental.treatment.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <div class="grid grid-rows-2 gap-1">
                <div class="grid grid-cols-2 gap-1">
                    <div>
                        <InputTextAuto v-model="form.dental_record_id" required :autofocus="true" :combinedNameId="true" label="Infirmary No" :options="clients" :errorMsg="form.errors.dental_record_id" @input="form.errors['dental_record_id'] = null;" />
                        <div v-if="selectedClient" class="flex justify-between gap-1">
                            <ViewField label="Infirmary ID" :value="selectedClient.id" class="text-sm" />
                            <ViewField label="Sex" :value="selectedClient.sex" class="text-sm capitalize" />
                            <ViewField label="Age" :value="selectedClient.age" class="text-sm" />
                        </div>
                        {{treatments}}
                    </div>

                </div>

            </div>
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import {BooleanValues, InOutPatient, Lab_Group_4, Lab_Group_6} from "@/Legends/legends";
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus, WardType} from "@/Legends/legends";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                dental_record_id: null,
                diagnosis: null,
                service_id: null,
                tooth_location: null,
                operator: null,
            }),
            selectedClient: null,
            data: null,
            clients: [],
            formTitle: '',
            treatments: [],
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        getDentalTreatment(id) {
            axios.get(route('api.dental.treatments.get', id))
                .then(response => {
                    this.treatments = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    watch: {
        'form.dental_record_id': function (val) {
            const temp = this.clients.find(client => client.id === val);
            if (temp) {
                this.form.rqst_id = temp.rqst_id;
                this.selectedClient = temp;
                this.getDentalTreatment(this.form.dental_record_id)
            }
            else {
                this.form.rqst_id = null;
                this.selectedClient = null;
                this.treatments = [];
            }
        },
    },
    mounted() {
        this.clients = this.$page.props.clients.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Dental Treatment Record';
        }
        else {
            this.formTitle = 'Create Dental Treatment Record';
            this.form.examination_date = new Date().toISOString().substr(0, 10);
        }
    }
};
</script>

