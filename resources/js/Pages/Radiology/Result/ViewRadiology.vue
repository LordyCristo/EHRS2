<template>
    <Laboratory title="View X-ray Result">
        <ViewForm :link="route('radiology.result.index')">
            <ViewHeader>X-RAY RESULT FORM</ViewHeader>
            <div class="grid grid-rows-1 gap-2 mb-5" v-if="data">
                <div class="grid grid-cols-4 gap-5">
                    <ViewField label="X-ray No." :value="data.xray.rqst_id" />
                    <ViewField label="Hospital No." :value="data.infirmary_id" />
                    <ViewField label="Date" :value="new Date(data.xray.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' })" />
                    <view-field label="OR No." :value="data.or_no?data.or_no:'Unpaid'" />
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <ViewField label="Patient" :value="formattedFullName(data.client)" />
                    <div  class="grid grid-cols-2 gap-5">
                        <ViewField label="Age" :value="data.client.age" />
                        <ViewField label="Sex" :value="data.client.sex" />
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5">
                    <ViewField label="Requesting Physician" :value="formattedFullName(data.rqst_physician)" />
                </div>
                <div class="grid grid-cols-1 gap-5">
                    <ViewField label="Procedure" :value="data.xray.procedure" />
                </div>
                <div class="grid grid-cols-1 gap-5 mb-16">
                    <ViewField label="Radiographic Findings" :value="data.xray.radiographic_findings" />
                    <div v-if="data.xray.radiograph" class="flex justify-center">
                        <img :src="data.xray.radiograph.image" class="uploading-image max-w-xl"  alt="sass"/>
                    </div>
                    <div v-else>
                        No Radiographic image
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5">
                    <ViewField label="Impression" :value="data.xray.impression" />
                </div>
                <view-footer>
                    <view-footer-item>
                        <template #name>{{formattedFullName(data.xray.radiographer)}}</template>
                        <template #license>{{ data.xray.radiographer.license_no }}</template>
                        <template #specialization>Radiological Technologist</template>
                    </view-footer-item>
                    <view-footer-item>
                        <template #name>{{formattedFullName(data.xray.radiologist)}}</template>
                        <template #license>{{ data.xray.radiologist.license_no }}</template>
                        <template #specialization>Radiologist</template>
                    </view-footer-item>
                </view-footer>
            </div>
            <div v-else class="text-center">
                <span>Unable to retrieve X-ray results</span>
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
