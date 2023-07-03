<template>
    <Dental title="View Fecalysis">
        <form @submit.prevent="submit" class="flex justify-center w-full">
            <div class="printTable flex flex-col container p-10 w-fit shadow-lg">
                <ViewHeader>Dental Certificate</ViewHeader>
                <div class="max-w-3xl" v-if="data">
                    <div class="grid grid-cols-[7]">
                        <div class="flex justify-end">
                            <ViewField label="Date" :value="formattedDate(new Date())" />
                        </div>
                        <div class="flex justify-start">
                            <ViewField label="TO WHOM IT IT MAY CONCERN" />
                        </div>
                        <div class="text-justify mt-5">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;THIS IS TO CERTIFY that <b>{{ formattedFullName(data.client) }}</b> of
                            <b>{{ data.client.curr_address }}</b> was examined and treated/confined in this hospital
                            <div class="flex">
                                <div class="flex items-center justify-center">on/from</div>
                                <InputText type="date" v-model="form.admission_date" />
                                <div class="flex items-center justify-center">to</div>
                                <InputText type="date" v-model="form.discharge_date" />
                                <div class="flex items-center justify-center">with the following findings and/or diagnosis:</div>
                            </div>

                            <InputTextArea v-model="form.diagnosis" />

                            <div class="flex items-center">
                                <div>
                                    and would need medical attention for
                                </div>
                                <InputText type="number" v-model="form.num_days" />
                                <div>
                                    days baring complications.
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <ViewField label="REMARKS" />
                        </div>
                        <div>
                            <InputTextArea v-model="form.remarks" />
                        </div>
                        <div class="grid grid-cols-2">
                            <SelectElement v-model="form.dentist" :options="dentists" label="Dentist" />
                            <InputTextAuto v-model="form.or_no" :options="or_nos" label="O.R. No." />
                        </div>
                    </div>
                </div>
                <div v-else>
                    <span>Unable to retrieve Dental Record</span>
                </div>
                <div class="flex justify-end mt-5">
                    <SubmitButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save & Print</SubmitButton>
                </div>
            </div>
        </form>
    </Dental>
</template>
<script setup>
import Dental from "@/Pages/Dental.vue";
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import ViewDtHead from "@/Components/Generic/Forms/ViewDtHead.vue";
import ViewDtLabel from "@/Components/Generic/Forms/ViewDtLabel.vue";
import ViewDtResult from "@/Components/Generic/Forms/ViewDtResult.vue";
import ViewFooter from "@/Components/Generic/Forms/ViewFooter.vue";
import ViewFooterItem from "@/Components/Generic/Forms/ViewFooterItem.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
</script>
<script>
import axios from "axios";
import {pushNotification} from "@/Components/Generic/Modals/NotifBanner.vue";
import {useForm} from "@inertiajs/vue3";
export default {
    data: () => ({
        data: null,
        dentists: [],
        or_nos: [],
        form: useForm({
            dentist: null,
            infirmary_id: null,
            or_no: null,
            diagnosis: null,
            num_days: null,
            admission_date: null,
            discharge_date: null,
            remarks: null,
        }),
    }),
    mounted() {
        this.data = this.$page.props.data.data;
        this.form.infirmary_id = this.data.client.infirmary_id;
        this.dentists = this.$page.props.dentists.data;
        this.or_nos = this.$page.props.or_nos.data;
    },
    methods: {
        formattedFullName(data) {
            return `${data.first_name} ${data.middle_name?data.middle_name[0]+'.':''} ${data.last_name} ${data.suffix?data.suffix:''}`;
        },
        formattedDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });
        },
        async submit() {
            await axios.post(route('api.dental.certificate.store'), this.form)
                .then(res => {
                    pushNotification(res.data.notification);
                    //redirect to print
                    this.form.reset();
                    window.location.href = route('dental.record.printable', res.data.data.id);
                })
                .catch((error) => {
                    this.form.errors = error.response.data.errors;
                    console.log(error.response);
                });
        },
    },
}
</script>
