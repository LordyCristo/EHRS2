<template>
    <Laboratory title="View Fecalysis">
        <ViewForm :link="route('laboratory.fecalysis.index')">
            <div class="printTable flex flex-col container py-6 w-fit">
                <ViewHeader>Fecalysis Report</ViewHeader>
                <div class="max-w-3xl" v-if="data">
                    <div class="flex flex-row justify-between gap-2 whitespace-nowrap" >
                        <view-field label="Patient" :value="formattedFullName(data.client)" />
                        <view-field label="Age" :value="data.client.age" />
                        <view-field label="Sex" :value="data.client.sex.toUpperCase()" />

                        <view-field label="Ward" :value="data.ward.toUpperCase()" />
                        <view-field label="OR No." :value="data.or_no?data.or_no:'Unpaid'" />
                    </div>
                    <div class="flex flex-row justify-between gap-2 whitespace-nowrap">
                        <view-field label="Requesting Physician" :value="`Dr. ${data.rqst_physician.first_name} ${data.rqst_physician.middle_name?data.rqst_physician.middle_name[0]+'.':''} ${data.rqst_physician.last_name} ${data.rqst_physician.suffix?data.rqst_physician.suffix:''}`" />
                        <view-field label="Hospital No." :value="data.infirmary_id" />
                        <view-field label="Date" :value="new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' })" />
                    </div>
                    <table class="table table-fixed my-2 w-full">
                        <view-dt-head>
                            <th colspan="2" style="width: 50%;">Macroscopic</th>
                            <th colspan="2" style="width: 50%;">Microscopic</th>
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
                                <view-dt-label style="border-right: 0">Others:</view-dt-label>
                                <view-dt-result colspan="3" style="border-left: 0; text-align: left">{{ data.fecalysis.others }}</view-dt-result>
                            </tr>
                            <tr>
                                <view-dt-label style="border-right: 0">Remarks:</view-dt-label>
                                <view-dt-result colspan="3" style="border-left: 0; text-align: left">{{ data.fecalysis.remarks }}</view-dt-result>
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
    methods: {
        formattedFullName(data) {
            return `${data.first_name} ${data.middle_name?data.middle_name[0]+'.':''} ${data.last_name} ${data.suffix?data.suffix:''}`;
        },
    },
}
</script>
