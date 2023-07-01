<template>
    <Laboratory title="Medical Records">
        <div class="flex flex-col p-10 mx-10">
            <ViewForm>
                <ViewHeader>MEDICAL CERTIFICATE</ViewHeader>
                <div v-if="data" class="flex flex-col gap-2 mb-5">
                    <div>
                        <ViewField label="Laboratory Requirements" class="mb-2"/>
                        <div class="grid grid-cols-2">
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.cbc}" class="border w-3 h-3"></div>
                                <span>Complete Blood Count</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.urinalysis}" class="border w-3 h-3"></div>
                                <span>Urinalysis</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.chest_xray}" class="border w-3 h-3"></div>
                                <span>Chest X-ray</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.fecalysis}" class="border w-3 h-3"></div>
                                <span>Fecalysis</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.drug_test}" class="border w-3 h-3"></div>
                                <span>Drug Test</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.psychological}" class="border w-3 h-3"></div>
                                <span>Psychological</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.neuropsychiatric}" class="border w-3 h-3"></div>
                                <span>Neuropsychiatric</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.nolabneeded}" class="border w-3 h-3"></div>
                                <span>No Lab Needed</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-5">
                        This is to certify that I have seen and examined {{ data.client.sex === 'male' ? 'Mr.' : 'Ms.' }}
                        <b class="underline">{{ formattedFullName(data.client) }}</b> that {{ data.client.sex === 'male' ? 'he' : 'she' }} is physically and/or
                        medically:
                        <div class="flex gap-2 justify-center">
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':data.is_fit}" class="border rounded-full w-3 h-3"></div>
                                <span>fit</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <div :class="{'bg-black border-gray-900':!data.is_fit}" class="border rounded-full w-3 h-3"></div>
                                <span>unfit</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-5">
                        <ViewField label="Purpose" class="mb-2" />
                        <div class="grid grid-rows-5">
                            <div v-for="option in purposes" :key="option.id" class="flex items-center gap-1 whitespace-nowrap">
                                <div :class="{'bg-black border-gray-900':option.id===data.purpose}" class="border rounded-full w-3 h-3">&nbsp;</div>
                                {{ option.name }}
                            </div>
                        </div>
                    </div>
                    <div v-if="data.purpose === 4" class="my-1">
                        <ViewField label="Specify Sport" class="mb-2" />
                        <p>
                            {{data.purpose_sport}}
                        </p>
                    </div>
                    <div v-if="data.purpose === 5" class="my-1">
                        <ViewField label="Specify Purpose" class="mb-2" />
                        <p>
                            {{data.specific_purpose}}
                        </p>
                    </div>
                    <div class="my-5">
                        <ViewFieldBelow label="Remarks" :value="data.remarks" class="mb-2" />
                        <p class="text-justify">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I have examined the above-named patient and completed the evaluation. The patient does not
                            present apparent clinical contraindications. However, if conditions arise after the
                            student/employee/staff/faculty have been cleared, the physician may rescind the clearance
                            until the problem is resolved.
                        </p>
                    </div>
                    <div class="flex mt-5">
                        <ViewField :value="`${formattedFullName(data.physician)}, M.D.`" label="Name and Signature of the Physician"/>
                    </div>
                    <ViewField :value="formattedDate()" label="Date Issued"/>
                </div>
                <div v-else class="text-center">
                    <span>Unable to retrieve Medical Data</span>
                </div>
            </ViewForm>
        </div>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import InputError from "@/Components/Generic/Forms/InputError.vue";
import SubmitButton from "@/Components/Generic/Buttons/SubmitButton.vue";
import ViewFieldBelow from "@/Components/Generic/Forms/ViewFieldBelow.vue";
import DisplayValue from "@/Components/Generic/Forms/DisplayValue.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";
import axios from "axios";
import {pushNotification} from "@/Components/Generic/Modals/NotifBanner.vue";

export default {
    data: () => ({
        data: null,
        purposes: [
            {id: 1, name: 'Pre-enrolment Medical Certification'},
            {id: 2, name: 'Educational tour/trip; seminar/convention'},
            {id: 3, name: 'Medical Requirement for On-the-job Training (OJT)'},
            {id: 4, name: 'Pre-participation Sports Clearance: Sports/Activity'},
            {id: 5, name: 'Others: Please Specify'},
        ],
    }),
    mounted() {
        this.data = this.$page.props.data.data;
    },
    methods: {
        formattedFullName(data) {
            return `${data.first_name} ${data.middle_name ? data.middle_name : ''} ${data.last_name} ${data.suffix ? data.suffix : ''}`;
        },
        formattedDate(date) {
            return new Date().toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'});
        },
        print(sectionID) {
            // get the ID of the section to be printed
            let section = document.getElementById(sectionID)
            // set the ID of the section to match CSS @media print rules
            section.setAttribute("id", "printThis")
            // print the section
            window.print();
            // set back the ID of the section to what it was...
            section.setAttribute("id", sectionID)
        },
    },

}
</script>
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #printThis, #printThis * {
        visibility: visible;
    }

    #printThis {
        position: absolute;
        left: 0;
        top: 0;
        padding: 2rem;
    }

    #printThis input{
        box-shadow: none;
    }
}
</style>

