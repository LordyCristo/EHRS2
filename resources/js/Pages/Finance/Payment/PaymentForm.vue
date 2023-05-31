<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="finance.payment.index"
                 :update-link="data? route('api.payment.update', data.id): null"
                 :store-link="route('api.payment.store')"
                 :delete-link="data? route('api.payment.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <div class="grid grid-cols-2">
                <InputText v-model="form.collector_id" label="Collector ID" type="number" :errorMsg="form.errors.collector_id" @input="form.errors['collector_id'] = null" />
                <InputText v-model.number="form.or_no" label="OR No." type="number" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
            </div>
            <InputText v-model="form.payor_name" label="Payor Name" :errorMsg="form.errors.payor_name" @input="form.errors['payor_name'] = null" />
            <div class="grid grid-cols-2">
                <InputText v-model="form.payor_email" label="Payor Email" :errorMsg="form.errors.payor_email" @input="form.errors['payor_email'] = null" />
                <InputText v-model="form.payor_mobile" label="Payor Mobile No." :errorMsg="form.errors.payor_mobile" @input="form.errors['payor_mobile'] = null" />
                <SelectElement v-model="form.client_id" label="Client" :options="clients" :errorMsg="form.errors.client_id" @input="form.errors['client_id'] = null" />
                <InputText v-model="form.total_amount" label="Total Amount" type="number" :errorMsg="form.errors.total_amount" @input="form.errors['total_amount'] = null" />
            </div>
            <div class="flex flex-col">
                <div class="inline-flex justify-evenly items-center my-2 border-y-2 py-1">
                    <div class="grid grid-cols-2 w-full text-center text-sm text-gray-600">
                        <label>Services<span v-if="form.rows.length">: {{ form.rows.length }}</span></label>
                        <label>Fees</label>
                    </div>
                    <div class="bg-gray-300 rounded-md mx-3 p-0.5 hover:scale-110 duration-100 active:scale-95 shadow-sm">
                        <AddIcon class="w-5 h-5 text-vsu-green " @click="addRow" />
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <input-error :message="form.errors.rows" />
                </div>
                <div v-for="(row, index) in form.rows" :key="index" class="inline-flex justify-between items-center my-0.5 rounded-md" :class="{'border border-red-300':form.errors.rows}">
                    <span class="text-gray-500 mx-1">{{ index + 1 }}</span>
                    <div class="grid grid-cols-2 w-full">
                        <SelectElement v-model="row.service_id" :options="services" @input="form.errors['rows'] = null" />
                        <InputText v-model="row.fee" type="number" @input="calculateTotalAmount(row.fee)" />
                    </div>
                    <div class="bg-gray-300 rounded-md mx-3 p-0.5 hover:scale-110 duration-100 active:scale-95 shadow-sm">
                        <CloseIcon class="w-5 h-5 text-red-500" @click="deleteRow(index)" />
                    </div>
                </div>
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
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import AddIcon from "@/Components/Icons/AddIcon.vue";
import InputError from "@/Components/Generic/Forms/InputError.vue";
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
            servicesCount: 0,
            form: useForm({
                or_no: null,
                payor_name: null,
                payor_email: null,
                payor_mobile: null,
                client_id: null,
                collector_id: null,
                total_amount: null,
                rows: [],
                remarks: null,
            }),
            clients: null,
            services: [],
            data: null,
            formTitle: null,
        };
    },
    created() {
        if (this.action === 'store')
            this.addRow(); // Add an initial row when the component is created

        this.clients = this.$page.props.clients.data;
        this.services = this.$page.props.services.data;
    },
    watch: {
        rows: {
            handler(newRows) {
                // Update row indexes
                newRows.forEach((row, index) => {
                    row.index = index + 1;
                });
            },
            deep: true,
        },
    },
    methods: {
        addRow() {
            this.form.rows.push({ service_id: null, fee: null });
        },
        deleteRow(index) {
            const fee = this.form.rows[index].fee; // Get the fee of the row to be deleted
            this.form.rows.splice(index, 1); // Remove the row from the form

            if (fee) {
                this.calculateTotalAmount(-fee); // Subtract the fee from the total amount
            }
        },
        calculateTotalAmount(fee) {
            this.form.total_amount = 0;
            this.form.rows.forEach((row) => {
                this.form.total_amount += parseInt(row.fee);
            });

            //this.form.total_amount += parseInt(fee); // Add the fee to the total amount
        },
    },
    mounted() {

        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.form.rows = this.data.paid_services;
            this.formTitle = 'Update Form Details';
        }
        else {
            this.form.or_no = this.$page.props.last_payment_id + 1;
            this.form.collector_id = this.$page.props.auth.user.id;
            this.formTitle = 'New Transaction Record';
        }
    }
};
</script>
