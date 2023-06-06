<template>
    <Laboratory title="View Urinalysis">
        <ViewForm :link="route('radiology.request.index')">
            <ViewHeader>X-RAY REQUEST</ViewHeader>
            {{data}}
            <div class="grid grid-rows-2" v-if="data">
                <div class="flex flex-row justify-between gap-2">
                    <view-field label="Patient" :value="formattedFullName(data.client)" />
                    <view-field label="Age" :value="data.age" />
                    <view-field label="Sex" :value="data.sex" />
                    <view-field label="Hospital No." :value="data.infirmary_id" />
                    <view-field label="Ward" :value="data.ward" />
                    <view-field label="OR No." :value="data.or_no?data.or_no:'Unpaid'" />
                </div>
                <div class="flex flex-row justify-between gap-2">
                    <view-field label="Requesting Physician" :value="`Dr. ${formattedFullName(data.rqst_physician)}`" />
                    <view-field label="Date" :value="new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' })" />
                </div>
                <table style="table-layout: fixed; margin: 0.5rem 0; border-collapse: collapse">
                    <view-dt-head>
                        <th colspan="2" style="width: 50%;">Macroscopic</th>
                        <th colspan="3" style="width: 50%;">Microscopic</th>
                    </view-dt-head>
                    <tbody>

                    </tbody>
                </table>
                <view-footer>
                    <view-footer-item>
                        <template #name>{{ formattedFullName(data.medical_technologist) }}</template>
                        <template #license>{{ data.medical_technologist.license_no }}</template>
                        <template #specialization>Medical Technologist</template>
                    </view-footer-item>
                    <view-footer-item>
                        <template #name>{{ formattedFullName(data.pathologist) }}</template>
                        <template #license>{{ data.pathologist.license_no }}</template>
                        <template #specialization>Pathologist</template>
                    </view-footer-item>
                </view-footer>
            </div>
        </ViewForm>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import ViewDtLabel from "@/Components/Generic/Forms/ViewDtLabel.vue";
import ViewDtResult from "@/Components/Generic/Forms/ViewDtResult.vue";
import ViewDtNote from "@/Components/Generic/Forms/ViewDtNote.vue";
import ViewDtNoteItem from "@/Components/Generic/Forms/ViewDtNoteItem.vue";
import ViewFooter from "@/Components/Generic/Forms/ViewFooter.vue";
import ViewFooterItem from "@/Components/Generic/Forms/ViewFooterItem.vue";
import ViewDtHead from "@/Components/Generic/Forms/ViewDtHead.vue";
</script>
<script>
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
    },
}
</script>
