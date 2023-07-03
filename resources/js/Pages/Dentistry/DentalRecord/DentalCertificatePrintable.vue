<template>
    <Dental title="View Fecalysis">
        <ViewForm>
            <ViewHeader>Dental Certificate</ViewHeader>
            <div class="max-w-3xl" v-if="data">
                <div class="grid grid-cols-[7] gap-5">
                    <div class="flex justify-end">
                        <ViewField label="Date" :value="formattedDate(data.created_at)" />
                    </div>
                    <div class="flex justify-start">
                        <ViewField label="TO WHOM IT IT MAY CONCERN" />
                    </div>
                    <div class="text-justify">
                        THIS IS TO CERTIFY that <b>{{ formattedFullName(data.client) }}</b> of
                        <b>{{ data.client.curr_address }}</b> was examined and treated/confined in this hospital on/from
                        {{ formattedDate(data.admission_date) }}
                        to
                        {{ formattedDate(data.discharge_date)}}
                        with the following findings and/or diagnosis:
                        {{ data.diagnosis }}
                        and would need medical attention for
                        {{ data.num_days }}
                        days baring complications.
                    </div>
                    <div class="flex flex-col justify-start">
                        <ViewField label="REMARKS" />
                        <div>
                            {{ data.remarks }}
                        </div>
                    </div>

                    <div class="flex flex-row justify-end mt-16">
                        <div class="flex flex-col justify-center">
                            <div class="flex justify-center">
                                <span class="border-t border-gray-500 px-10">Dr. {{ formattedFullName(data.dentist) }}</span>
                            </div>
                            <div class="flex justify-center">
                                License:<span class="border-b border-gray-500 px-5">{{ data.dentist.license_no }}</span>
                            </div>
                            <div class="flex justify-center">
                                Paid w/ O.R. No.: <span class="border-b border-gray-500 px-5"> {{ data.or_no?data.or_no:'unpaid' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ViewForm>
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
</script>
<script>
import axios from "axios";
import {pushNotification} from "@/Components/Generic/Modals/NotifBanner.vue";
export default {
    data: () => ({
        data: null,
    }),
    mounted() {
        this.data = this.$page.props.data.data;
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
            if(this.form.purpose === 4 && !this.form.purpose_sport){
                this.form.errors.purpose_sport = 'Required field';
                return;
            }else if(this.form.purpose === 5 && !this.form.specific_purpose){
                this.form.errors.specific_purpose = 'Required field';
                return;
            }
            await axios.post(route('api.certificate.store'), this.form)
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
