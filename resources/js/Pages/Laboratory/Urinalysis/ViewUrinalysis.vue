<template>
    <Laboratory title="View Urinalysis">
        <ViewForm :link="route('laboratory.urinalysis.index')">
            <ViewHeader>Urinalysis Report</ViewHeader>
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
                    <tr>
                        <view-dt-label>Color</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.color }}</view-dt-result>
                        <view-dt-label>WBC</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.wbc }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Clarity</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.clarity }}</view-dt-result>
                        <view-dt-label>RBC</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.rbc }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem;">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label colspan="2" style="background-color: rgb(6,67,13); color:white; text-align: center; border: 1px solid black;">Chemical Examination</view-dt-label>
                        <view-dt-label>Epithelial Cells</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.epithelial_cells }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/lpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>pH</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.ph }}</view-dt-result>
                        <view-dt-label>Bacteria</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.bacteria }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Specific Gravity</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.specific_gravity }}</view-dt-result>
                        <view-dt-label>Amorphous Urates</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.amorphous_urates }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Albumin</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.albumin }}</view-dt-result>
                        <view-dt-label>Amorphous Phosphates</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.amorphous_phosphates }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Glucose</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.glucose }}</view-dt-result>
                        <view-dt-label>Mucous Threads</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.mucous_threads }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/lpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Blood</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.glucose }}</view-dt-result>
                        <view-dt-label colspan="3"></view-dt-label>
                    </tr>
                    <tr>
                        <view-dt-label>Leukocytes</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.leukocytes }}</view-dt-result>
                        <view-dt-label colspan="3">Crystals</view-dt-label>
                    </tr>
                    <tr>
                        <view-dt-label>Nitrite</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.nitrite }}</view-dt-result>
                        <view-dt-result colspan="2">{{ data.urinalysis.crystals }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/hpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Bilirubin</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.bilirubin }}</view-dt-result>
                        <view-dt-label colspan="3">Cast</view-dt-label>
                    </tr>
                    <tr>
                        <view-dt-label>Urobilinogen</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.urobilinogen }}</view-dt-result>
                        <view-dt-result colspan="2">{{ data.urinalysis.cast }}</view-dt-result>
                        <view-dt-note style="max-width: 1rem">
                            <view-dt-note-item>/lpf</view-dt-note-item>
                        </view-dt-note>
                    </tr>
                    <tr>
                        <view-dt-label>Ketones</view-dt-label>
                        <view-dt-result>{{ data.urinalysis.ketones }}</view-dt-result>
                        <view-dt-label>Remarks</view-dt-label>
                        <view-dt-result colspan="2">{{ data.urinalysis.remarks }}</view-dt-result>
                    </tr>
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
