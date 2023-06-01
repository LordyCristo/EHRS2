<template>
    <Laboratory title="View Hematology">
        <ViewForm :link="route('laboratory.fecalysis.index')">
            <div class="printTable flex flex-col">
                <ViewHeader>Fecalysis Report</ViewHeader>
                <div class="grid grid-rows-2" v-if="data">
                    <div class="flex flex-row justify-between gap-2">
                        <view-field label="Patient" :value="data.infirmary_id" />
                        <view-field label="Age" :value="data.age" />
                        <view-field label="Sex" :value="data.sex" />
                        <view-field label="Hospital No." :value="data.hospital_no" />
                        <view-field label="Ward" :value="data.ward" />
                        <view-field label="OR No." :value="data.or_no?data.or_no:'Unpaid'" />
                    </div>
                    <div class="flex flex-row justify-between gap-2">
                        <view-field label="Requesting Physician" :value="`Dr. ${data.rqst_physician.first_name} ${data.rqst_physician.middle_name?data.rqst_physician.middle_name[0]+'.':''} ${data.rqst_physician.last_name} ${data.rqst_physician.suffix?data.rqst_physician.suffix:''}`" />
                        <view-field label="Date" :value="new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' })" />
                    </div>
                    <table class="table-auto my-2">
                        <view-dt-head>
                            <th colspan="2">Macroscopic</th>
                            <th colspan="2"  >Microscopic</th>
                        </view-dt-head>
                        <tbody>
                            <tr>
                                <view-dt-label>Color</view-dt-label>
                                <view-dt-result>{{ data.fecalysis.color }}</view-dt-result>
                                <view-dt-label colspan="2">Ova:</view-dt-label>
                            </tr>
                            <tr>
                                <view-dt-label>Consistency</view-dt-label>
                                <view-dt-result>{{ data.fecalysis.consistency }}</view-dt-result>
                                <view-dt-result colspan="2">{{ data.fecalysis.ova }}</view-dt-result>
                            </tr>
                            <tr>
                                <view-dt-label colspan="2"></view-dt-label>
                                <view-dt-label>White Blood Cells</view-dt-label>
                                <view-dt-result>{{ data.fecalysis.wbc }}</view-dt-result>
                            </tr>
                            <tr>
                                <view-dt-label colspan="2"></view-dt-label>
                                <view-dt-label>Red Blood Cells</view-dt-label>
                                <view-dt-result>{{ data.fecalysis.rbc }}</view-dt-result>
                            </tr>
                            <tr>
                                <view-dt-label colspan="2"></view-dt-label>
                                <view-dt-label>Fat Globules</view-dt-label>
                                <view-dt-result>{{ data.fecalysis.fat_globules }}</view-dt-result>
                            </tr>
                            <tr>
                                <view-dt-label colspan="4">Others:</view-dt-label>
                            </tr>
                            <tr>
                                <view-dt-label colspan="4">Remarks:</view-dt-label>
                            </tr>
                        </tbody>
                    </table>
                    <view-footer>
                        <view-footer-item>
                            <template #name>{{ data.medical_technologist.first_name }} {{ data.medical_technologist.middle_name[0] }}. {{ data.medical_technologist.last_name }} {{ data.medical_technologist.suffix }}</template>
                            <template #license>{{ data.medical_technologist.license_no }}</template>
                            <template #specialization>Medical Technologist</template>
                        </view-footer-item>
                        <view-footer-item>
                            <template #name>{{ data.pathologist.first_name }} {{ data.pathologist.middle_name[0] }}. {{ data.pathologist.last_name }} {{ data.pathologist.suffix }}</template>
                            <template #license>{{ data.pathologist.license_no }}</template>
                            <template #specialization>Pathologist</template>
                        </view-footer-item>
                    </view-footer>
                </div>
            </div>
        </ViewForm>
    </Laboratory>
</template>
<script setup>
import Laboratory from '@/Pages/Laboratories.vue';
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
import ViewHeader from "@/Components/Generic/Forms/ViewHeader.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
import ViewDtHead from "@/Components/Generic/Forms/ViewDtHead.vue";
import ViewDtLabel from "@/Components/Generic/Forms/ViewDtLabel.vue";
import ViewDtResult from "@/Components/Generic/Forms/ViewDtResult.vue";
import ViewFooter from "@/Components/Generic/Forms/ViewFooter.vue";
import ViewFooterItem from "@/Components/Generic/Forms/ViewFooterItem.vue";
</script>
<script>
export default {
    data: () => ({
        data: null,

    }),
    mounted() {
        this.data = this.$page.props.data.data;
    },
}
</script>
