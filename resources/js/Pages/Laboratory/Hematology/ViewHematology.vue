<template>
    <Laboratory title="View Hematology">
        <ViewForm :link="route('laboratory.hematology.index')">
            <ViewHeader>Hematology Report</ViewHeader>
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
                        <th>Examination</th>
                        <th>Results</th>
                        <th>Normal Values</th>
                        <th>Examination</th>
                        <th>Results</th>
                        <th>Normal Values</th>
                    </view-dt-head>
                    <tbody>
                    <tr>
                        <view-dt-label>Hemoglobin</view-dt-label>
                        <view-dt-result>{{ data.hematology.hemoglobin }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item><span>NB</span><span>17.0-22.0 g/dl</span></view-dt-note-item>
                            <view-dt-note-item><span>Child</span><span>12.0-15.0 g/dl</span></view-dt-note-item>
                            <view-dt-note-item><span>F</span><span>11.0-16.0 g/dl</span></view-dt-note-item>
                            <view-dt-note-item><span>M</span><span>14.0-18.0 g/dl</span></view-dt-note-item>
                        </view-dt-note>
                        <view-dt-label>Segmenters</view-dt-label>
                        <view-dt-result>{{ data.hematology.segmenters }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item>0.50 - 0.70</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Hematocrit</view-dt-label>
                        <view-dt-result>{{ data.hematology.hematocrit }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item><span>NB</span><span>0.35 - 0.49</span></view-dt-note-item>
                            <view-dt-note-item><span>Child</span><span>0.35 - 0.49</span></view-dt-note-item>
                            <view-dt-note-item><span>F</span><span>0.36 - 0.48</span></view-dt-note-item>
                            <view-dt-note-item><span>M</span><span>0.40 - 0.54</span></view-dt-note-item>
                        </view-dt-note>
                        <view-dt-label>Lymphocyte</view-dt-label>
                        <view-dt-result>{{ data.hematology.lymphocyte }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item>0.20 - 0.40</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>White Blood Cells</view-dt-label>
                        <view-dt-result>{{ data.hematology.wbc }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item><span>NB</span><span>15.0 - 22.0 x 10<sup>9</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>Child</span><span>5.0 - 12.0 x 10<sup>9</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>F</span><span>4.0 - 10.0 x 10<sup>9</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>M</span><span>4.0 - 10.0 x 10<sup>9</sup>/L</span></view-dt-note-item>
                        </view-dt-note>
                        <view-dt-label>Monoctye</view-dt-label>
                        <view-dt-result>{{ data.hematology.monocyte }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item>0.01 - 0.15</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Red Blood Cells</view-dt-label>
                        <view-dt-result>{{ data.hematology.rbc }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item><span>NB</span><span>6.0 - 7.0 x 10<sup>12</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>Child</span><span>4.0 - 5.2 x 10<sup>12</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>F</span><span>3.5.0 - 5.5 x 10<sup>12</sup>/L</span></view-dt-note-item>
                            <view-dt-note-item><span>M</span><span>4.5 - 6.0 x 10<sup>12</sup>/L</span></view-dt-note-item>
                        </view-dt-note>
                        <view-dt-label>Blood Type</view-dt-label>
                        <view-dt-result>{{ data.hematology.blood_type }}</view-dt-result>
                        <view-dt-note></view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Platelet Count</view-dt-label>
                        <view-dt-result>{{ data.hematology.platelet_count }}</view-dt-result>
                        <view-dt-note>
                            <view-dt-note-item><span></span><span>150 - 450 x 10<sup>9</sup>/L</span></view-dt-note-item>
                        </view-dt-note>
                        <view-dt-label>Others</view-dt-label>
                        <view-dt-note></view-dt-note>
                        <view-dt-note></view-dt-note>
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
}
</script>
