<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="dental.index"
                 :update-link="data? route('api.dental.update', data.id): null"
                 :store-link="route('api.dental.store')"
                 :delete-link="data? route('api.dental.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <!--header form-->
            <div class="grid grid-cols-2 gap-1">
                <InputTextAuto v-model="form.infirmary_id" required :autofocus="true"  label="Infirmary No" :options="clients" :errorMsg="form.errors.infirmary_id" @input="form.errors['infirmary_id'] = null" />
                <div class="grid grid-cols-2 gap-1">
                    <InputTextAuto v-model="form.or_no" label="OR No." :options="or_nos" :errorMsg="form.errors.or_no" @input="form.errors['or_no'] = null" />
                    <RadioButton v-model="form.is_out_patient" required label="In/Out Patient" :options="InOutPatient" :errorMsg="form.errors.is_out_patient" @input="form.errors['is_out_patient'] = null" />
                </div>
            </div>
            <!--end of header form-->
            <!--fecalysis body form-->
            <div class="my-2 border-y py-5 gap-2">
                <div class="grid grid-rows-2 p-2 border">
                    <div class="flex flex-row gap-3 justify-between">
                        <label class="font-semibold">OPERATION</label>
                        <div class="grid grid-cols-10 gap-3 max-w-fit">
                            <Checkbox v-model="form.lb_op_up_55" label="55"/>
                            <Checkbox v-model="form.lb_op_up_54" label="54"/>
                            <Checkbox v-model="form.lb_op_up_53" label="53"/>
                            <Checkbox v-model="form.lb_op_up_52" label="52"/>
                            <Checkbox v-model="form.lb_op_up_51" label="51"/>
                            <Checkbox v-model="form.lb_op_up_61" label="61"/>
                            <Checkbox v-model="form.lb_op_up_62" label="62"/>
                            <Checkbox v-model="form.lb_op_up_63" label="63"/>
                            <Checkbox v-model="form.lb_op_up_64" label="64"/>
                            <Checkbox v-model="form.lb_op_up_65" label="65"/>
                        </div>
                    </div>
                    <div class="flex flex-row gap-3 justify-between">
                        <label class="font-semibold">CONDITION</label>
                        <div class="grid grid-cols-10 gap-3 max-w-fit">
                            <Checkbox v-model="form.lb_cond_up_55" label="55"/>
                            <Checkbox v-model="form.lb_cond_up_54" label="54"/>
                            <Checkbox v-model="form.lb_cond_up_53" label="53"/>
                            <Checkbox v-model="form.lb_cond_up_52" label="52"/>
                            <Checkbox v-model="form.lb_cond_up_51" label="51"/>
                            <Checkbox v-model="form.lb_cond_up_61" label="61"/>
                            <Checkbox v-model="form.lb_cond_up_62" label="62"/>
                            <Checkbox v-model="form.lb_cond_up_63" label="63"/>
                            <Checkbox v-model="form.lb_cond_up_64" label="64"/>
                            <Checkbox v-model="form.lb_cond_up_65" label="65"/>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center font-semibold uppercase my-2">
                    <label>(Labio-Buccal)</label>
                </div>
                <div class="flex flex-row gap-3 items-center justify-between p-2 border">
                    <label class="font-semibold">RIGHT</label>
                    <div class="grid grid-cols-10 gap-3 max-w-fit">
                        <Checkbox v-model="form.lb_up_55" label="55"/>
                        <Checkbox v-model="form.lb_up_54" label="54"/>
                        <Checkbox v-model="form.lb_up_53" label="53"/>
                        <Checkbox v-model="form.lb_up_52" label="52"/>
                        <Checkbox v-model="form.lb_up_51" label="51"/>
                        <Checkbox v-model="form.lb_up_61" label="61"/>
                        <Checkbox v-model="form.lb_up_62" label="62"/>
                        <Checkbox v-model="form.lb_up_63" label="63"/>
                        <Checkbox v-model="form.lb_up_64" label="64"/>
                        <Checkbox v-model="form.lb_up_65" label="65"/>
                    </div>
                    <label class="font-semibold">LEFT</label>
                </div>
                <div class="flex justify-center font-semibold uppercase my-2">
                    <label>(Labio-Buccal)</label>
                </div>
               <div class="flex flex-col gap-2">
                   <div class="grid grid-rows-2 border p-2">
                       <div class="flex flex-row gap-3 justify-between">
                           <label class="font-semibold">OPERATION</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_op_up_18" label="18"/>
                               <Checkbox v-model="form.lb_op_up_17" label="17"/>
                               <Checkbox v-model="form.lb_op_up_16" label="16"/>
                               <Checkbox v-model="form.lb_op_up_15" label="15"/>
                               <Checkbox v-model="form.lb_op_up_14" label="14"/>
                               <Checkbox v-model="form.lb_op_up_13" label="13"/>
                               <Checkbox v-model="form.lb_op_up_12" label="12"/>
                               <Checkbox v-model="form.lb_op_up_11" label="11"/>
                               <Checkbox v-model="form.lb_op_up_21" label="21"/>
                               <Checkbox v-model="form.lb_op_up_22" label="22"/>
                               <Checkbox v-model="form.lb_op_up_23" label="23"/>
                               <Checkbox v-model="form.lb_op_up_24" label="24"/>
                               <Checkbox v-model="form.lb_op_up_25" label="25"/>
                               <Checkbox v-model="form.lb_op_up_26" label="26"/>
                               <Checkbox v-model="form.lb_op_up_27" label="27"/>
                               <Checkbox v-model="form.lb_op_up_28" label="28"/>
                           </div>
                       </div>
                       <div class="flex flex-row gap-3 justify-between">
                           <label class="font-semibold">CONDITION</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_cond_up_18" label="18"/>
                               <Checkbox v-model="form.lb_cond_up_17" label="17"/>
                               <Checkbox v-model="form.lb_cond_up_16" label="16"/>
                               <Checkbox v-model="form.lb_cond_up_15" label="15"/>
                               <Checkbox v-model="form.lb_cond_up_14" label="14"/>
                               <Checkbox v-model="form.lb_cond_up_13" label="13"/>
                               <Checkbox v-model="form.lb_cond_up_12" label="12"/>
                               <Checkbox v-model="form.lb_cond_up_11" label="11"/>
                               <Checkbox v-model="form.lb_cond_up_21" label="21"/>
                               <Checkbox v-model="form.lb_cond_up_22" label="22"/>
                               <Checkbox v-model="form.lb_cond_up_23" label="23"/>
                               <Checkbox v-model="form.lb_cond_up_24" label="24"/>
                               <Checkbox v-model="form.lb_cond_up_25" label="25"/>
                               <Checkbox v-model="form.lb_cond_up_26" label="26"/>
                               <Checkbox v-model="form.lb_cond_up_27" label="27"/>
                               <Checkbox v-model="form.lb_cond_up_28" label="28"/>
                           </div>
                       </div>
                   </div>
                   <div class="border p-2">
                       <div class="flex flex-row gap-3 justify-between">
                           <label class="font-semibold">UPPER</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_up_18" label="18"/>
                               <Checkbox v-model="form.lb_up_17" label="17"/>
                               <Checkbox v-model="form.lb_up_16" label="16"/>
                               <Checkbox v-model="form.lb_up_15" label="15"/>
                               <Checkbox v-model="form.lb_up_14" label="14"/>
                               <Checkbox v-model="form.lb_up_13" label="13"/>
                               <Checkbox v-model="form.lb_up_12" label="12"/>
                               <Checkbox v-model="form.lb_up_11" label="11"/>
                               <Checkbox v-model="form.lb_up_21" label="21"/>
                               <Checkbox v-model="form.lb_up_22" label="22"/>
                               <Checkbox v-model="form.lb_up_23" label="23"/>
                               <Checkbox v-model="form.lb_up_24" label="24"/>
                               <Checkbox v-model="form.lb_up_25" label="25"/>
                               <Checkbox v-model="form.lb_up_26" label="26"/>
                               <Checkbox v-model="form.lb_up_27" label="27"/>
                               <Checkbox v-model="form.lb_up_28" label="28"/>
                           </div>
                       </div>
                       <div class="flex flex-row gap-3 justify-between =">
                           <label class="font-semibold">LOWER</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_low_48" label="48"/>
                               <Checkbox v-model="form.lb_low_47" label="47"/>
                               <Checkbox v-model="form.lb_low_46" label="46"/>
                               <Checkbox v-model="form.lb_low_45" label="45"/>
                               <Checkbox v-model="form.lb_low_44" label="44"/>
                               <Checkbox v-model="form.lb_low_43" label="43"/>
                               <Checkbox v-model="form.lb_low_42" label="42"/>
                               <Checkbox v-model="form.lb_low_41" label="41"/>
                               <Checkbox v-model="form.lb_low_31" label="31"/>
                               <Checkbox v-model="form.lb_low_32" label="32"/>
                               <Checkbox v-model="form.lb_low_33" label="33"/>
                               <Checkbox v-model="form.lb_low_34" label="34"/>
                               <Checkbox v-model="form.lb_low_35" label="35"/>
                               <Checkbox v-model="form.lb_low_36" label="36"/>
                               <Checkbox v-model="form.lb_low_37" label="37"/>
                               <Checkbox v-model="form.lb_low_38" label="38"/>
                           </div>
                       </div>
                   </div>
                   <div class="border p-2">
                       <div class="flex flex-row gap-3 justify-between">
                           <label class="font-semibold">OPERATION</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_op_low_48" label="48"/>
                               <Checkbox v-model="form.lb_op_low_47" label="47"/>
                               <Checkbox v-model="form.lb_op_low_46" label="46"/>
                               <Checkbox v-model="form.lb_op_low_45" label="45"/>
                               <Checkbox v-model="form.lb_op_low_44" label="44"/>
                               <Checkbox v-model="form.lb_op_low_43" label="43"/>
                               <Checkbox v-model="form.lb_op_low_42" label="42"/>
                               <Checkbox v-model="form.lb_op_low_41" label="41"/>
                               <Checkbox v-model="form.lb_op_low_31" label="31"/>
                               <Checkbox v-model="form.lb_op_low_32" label="32"/>
                               <Checkbox v-model="form.lb_op_low_33" label="33"/>
                               <Checkbox v-model="form.lb_op_low_34" label="34"/>
                               <Checkbox v-model="form.lb_op_low_35" label="35"/>
                               <Checkbox v-model="form.lb_op_low_36" label="36"/>
                               <Checkbox v-model="form.lb_op_low_37" label="37"/>
                               <Checkbox v-model="form.lb_op_low_38" label="38"/>
                           </div>
                       </div>
                       <div class="flex flex-row gap-3 justify-between">
                           <label class="font-semibold">CONDITION</label>
                           <div class="flex flex-row gap-3">
                               <Checkbox v-model="form.lb_cond_low_48" label="48"/>
                               <Checkbox v-model="form.lb_cond_low_47" label="47"/>
                               <Checkbox v-model="form.lb_cond_low_46" label="46"/>
                               <Checkbox v-model="form.lb_cond_low_45" label="45"/>
                               <Checkbox v-model="form.lb_cond_low_44" label="44"/>
                               <Checkbox v-model="form.lb_cond_low_43" label="43"/>
                               <Checkbox v-model="form.lb_cond_low_42" label="42"/>
                               <Checkbox v-model="form.lb_cond_low_41" label="41"/>
                               <Checkbox v-model="form.lb_cond_low_31" label="31"/>
                               <Checkbox v-model="form.lb_cond_low_32" label="32"/>
                               <Checkbox v-model="form.lb_cond_low_33" label="33"/>
                               <Checkbox v-model="form.lb_cond_low_34" label="34"/>
                               <Checkbox v-model="form.lb_cond_low_35" label="35"/>
                               <Checkbox v-model="form.lb_cond_low_36" label="36"/>
                               <Checkbox v-model="form.lb_cond_low_37" label="37"/>
                               <Checkbox v-model="form.lb_cond_low_38" label="38"/>
                           </div>
                       </div>
                   </div>
               </div>
                <div class="flex justify-center font-semibold uppercase my-2">
                    <label>(Labio-Buccal)</label>
                </div>
                <div class="flex flex-row gap-3 items-center justify-between p-2 border">
                    <label class="font-semibold">RIGHT</label>
                    <div class="grid grid-cols-10 gap-3 max-w-fit">
                        <Checkbox v-model="form.lb_low_85" label="85"/>
                        <Checkbox v-model="form.lb_low_84" label="84"/>
                        <Checkbox v-model="form.lb_low_83" label="83"/>
                        <Checkbox v-model="form.lb_low_82" label="82"/>
                        <Checkbox v-model="form.lb_low_81" label="81"/>
                        <Checkbox v-model="form.lb_low_71" label="71"/>
                        <Checkbox v-model="form.lb_low_72" label="72"/>
                        <Checkbox v-model="form.lb_low_73" label="73"/>
                        <Checkbox v-model="form.lb_low_74" label="74"/>
                        <Checkbox v-model="form.lb_low_75" label="75"/>
                    </div>
                    <label class="font-semibold">LEFT</label>
                </div>
                <div class="grid grid-rows-2 border p-2 my-2">
                    <div class="flex flex-row gap-3 justify-between">
                        <label class="font-semibold">OPERATION</label>
                        <div class="grid grid-cols-10 gap-3 max-w-fit">
                            <Checkbox v-model="form.lb_op_low_85" label="85"/>
                            <Checkbox v-model="form.lb_op_low_84" label="84"/>
                            <Checkbox v-model="form.lb_op_low_83" label="83"/>
                            <Checkbox v-model="form.lb_op_low_82" label="82"/>
                            <Checkbox v-model="form.lb_op_low_81" label="81"/>
                            <Checkbox v-model="form.lb_op_low_71" label="71"/>
                            <Checkbox v-model="form.lb_op_low_72" label="72"/>
                            <Checkbox v-model="form.lb_op_low_73" label="73"/>
                            <Checkbox v-model="form.lb_op_low_74" label="74"/>
                            <Checkbox v-model="form.lb_op_low_75" label="75"/>
                        </div>
                    </div>
                    <div class="flex flex-row gap-3 justify-between">
                        <label class="font-semibold">CONDITION</label>
                        <div class="grid grid-cols-10 gap-3 max-w-fit">
                            <Checkbox v-model="form.lb_cond_low_85" label="85"/>
                            <Checkbox v-model="form.lb_cond_low_84" label="84"/>
                            <Checkbox v-model="form.lb_cond_low_83" label="83"/>
                            <Checkbox v-model="form.lb_cond_low_82" label="82"/>
                            <Checkbox v-model="form.lb_cond_low_81" label="81"/>
                            <Checkbox v-model="form.lb_cond_low_71" label="71"/>
                            <Checkbox v-model="form.lb_cond_low_72" label="72"/>
                            <Checkbox v-model="form.lb_cond_low_73" label="73"/>
                            <Checkbox v-model="form.lb_cond_low_74" label="74"/>
                            <Checkbox v-model="form.lb_cond_low_75" label="75"/>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 border p-2">
                    <RadioButton v-model="form.dental_caries" required label="Presence of dental caries" :options="BooleanValues" :errorMsg="form.errors.dental_caries" @input="form.errors['dental_caries'] = null" />
                    <RadioButton v-model="form.gingivitis" required :options="BooleanValues" label="Presence of gingivitis" :errorMsg="form.errors.gingivitis" @input="form.errors['gingivitis'] = null" />
                    <RadioButton v-model="form.periodontal_pocket" required :options="BooleanValues" label="Presence of periodical pocket" :errorMsg="form.errors.periodontal_pocket" @input="form.errors['periodontal_pocket'] = null" />
                    <RadioButton v-model="form.debris" required :options="BooleanValues" label="Presence of debris" :errorMsg="form.errors.debris" @input="form.errors['debris'] = null" />
                    <RadioButton v-model="form.calculus" required :options="BooleanValues" label="Presence of calculus" :errorMsg="form.errors.calculus" @input="form.errors['calculus'] = null" />
                    <RadioButton v-model="form.neoplasm" required :options="BooleanValues" label="Presence of neoplasm" :errorMsg="form.errors.neoplasm" @input="form.errors['neoplasm'] = null" />
                    <RadioButton v-model="form.dento_facial" required :options="BooleanValues" label="Presence of dento-facial anomaly" :errorMsg="form.errors.dento_facial" @input="form.errors['dento_facial'] = null" />
                </div>
                <div class="border p-2 grid grid-cols-4 mt-2">
                    <InputText v-model="form.cnt_prst_teeth" required type="number" label="Number of Teeth Present" :errorMsg="form.errors.cnt_prst_teeth" @input="form.errors['cnt_prst_teeth'] = null" />
                    <InputText v-model="form.cnt_indct_filing" required type="number" label="Caries indicated for Filling" :errorMsg="form.errors.cnt_indct_filing" @input="form.errors['cnt_indct_filing'] = null" />
                    <InputText v-model="form.cnt_indct_extraction" required type="number" label="Caries indicated for Extraction" :errorMsg="form.errors.cnt_indct_extraction" @input="form.errors['cnt_indct_extraction'] = null" />
                    <InputText v-model="form.root_frgmt" required type="number" label="Root Fragment" :errorMsg="form.errors.root_frgmt" @input="form.errors['root_frgmt'] = null" />
                    <InputText v-model="form.cnt_mssng_due_caries" required type="number" label="Missing Due to Caries" :errorMsg="form.errors.cnt_mssng_due_caries" @input="form.errors['cnt_mssng_due_caries'] = null" />
                    <InputText v-model="form.filled_restored" required type="number" label="Filled of Restored" :errorMsg="form.errors.filled_restored" @input="form.errors['filled_restored'] = null" />
                    <InputText v-model="form.cnt_df_dmf" required type="number" label="Total DF and DMF Teeth" :errorMsg="form.errors.cnt_df_dmf" @input="form.errors['cnt_df_dmf'] = null" />
                    <InputText v-model="form.flouride_app" required type="number" label="Fluoride Application" :errorMsg="form.errors.flouride_app" @input="form.errors['flouride_app'] = null" />
                </div>
            </div>
            <div class="grid grid-cols-2">
                <Datepicker v-model="form.examination_date" required label="Examination Date" :errorMsg="form.errors.examination_date" @input="form.errors['examination_date'] = null; computeAge();" />
                <InputText v-model="form.age_last_birthday" type="number" required label="Age Last Birthday" :errorMsg="form.errors.age_last_birthday" @input="form.errors['age_last_birthday'] = null;" />
            </div>
            <div class="grid grid-cols-2 gap-1">
                <SelectElement v-model="form.dentist" required :options="physicians" label="Dentist" :errorMsg="form.errors.dentist" @input="form.errors['dentist'] = null" />
            </div>
            <RadioButton v-model="form.status" required id="status" label="Status" :options="statuses" :errorMsg="form.errors.status" @input="onFocusClearError('status')" />
            <!--end of fecalysis footer form-->
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextArea from "@/Components/Generic/Forms/InputTextArea.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
import {BooleanValues, InOutPatient, Lab_Group_4, Lab_Group_6} from "@/Legends/legends";
import Checkbox from "@/Components/Generic/Forms/Checkbox.vue";
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import {Sex, BloodType, RecordStatus, WardType} from "@/Legends/legends";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                // dental record
                infirmary_id: null,
                dentist: null,
                or_no: null,
                is_out_patient: null,
                status: null,
                //dental result
                examination_date: null,
                age_last_birthday: null,
                //labio-buccal upper
                lb_up_55: false,
                lb_up_54: false,
                lb_up_53: false,
                lb_up_52: false,
                lb_up_51: false,
                lb_up_61: false,
                lb_up_62: false,
                lb_up_63: false,
                lb_up_64: false,
                lb_up_65: false,
                //labio-buccal upper operation
                lb_op_up_55: false,
                lb_op_up_54: false,
                lb_op_up_53: false,
                lb_op_up_52: false,
                lb_op_up_51: false,
                lb_op_up_61: false,
                lb_op_up_62: false,
                lb_op_up_63: false,
                lb_op_up_64: false,
                lb_op_up_65: false,
                //labio-buccal upper condition
                lb_cond_up_55: false,
                lb_cond_up_54: false,
                lb_cond_up_53: false,
                lb_cond_up_52: false,
                lb_cond_up_51: false,
                lb_cond_up_61: false,
                lb_cond_up_62: false,
                lb_cond_up_63: false,
                lb_cond_up_64: false,
                lb_cond_up_65: false,
                // labio-buccal upper
                lb_up_18: false,
                lb_up_17: false,
                lb_up_16: false,
                lb_up_15: false,
                lb_up_14: false,
                lb_up_13: false,
                lb_up_12: false,
                lb_up_11: false,
                lb_up_21: false,
                lb_up_22: false,
                lb_up_23: false,
                lb_up_24: false,
                lb_up_25: false,
                lb_up_26: false,
                lb_up_27: false,
                lb_up_28: false,
                //labio-buccal upper operation
                lb_op_up_18: false,
                lb_op_up_17: false,
                lb_op_up_16: false,
                lb_op_up_15: false,
                lb_op_up_14: false,
                lb_op_up_13: false,
                lb_op_up_12: false,
                lb_op_up_11: false,
                lb_op_up_21: false,
                lb_op_up_22: false,
                lb_op_up_23: false,
                lb_op_up_24: false,
                lb_op_up_25: false,
                lb_op_up_26: false,
                lb_op_up_27: false,
                lb_op_up_28: false,
                //labio-buccal upper condition
                lb_cond_up_18: false,
                lb_cond_up_17: false,
                lb_cond_up_16: false,
                lb_cond_up_15: false,
                lb_cond_up_14: false,
                lb_cond_up_13: false,
                lb_cond_up_12: false,
                lb_cond_up_11: false,
                lb_cond_up_21: false,
                lb_cond_up_22: false,
                lb_cond_up_23: false,
                lb_cond_up_24: false,
                lb_cond_up_25: false,
                lb_cond_up_26: false,
                lb_cond_up_27: false,
                lb_cond_up_28: false,
                //labio-buccal lower
                lb_low_48: false,
                lb_low_47: false,
                lb_low_46: false,
                lb_low_45: false,
                lb_low_44: false,
                lb_low_43: false,
                lb_low_42: false,
                lb_low_41: false,
                lb_low_31: false,
                lb_low_32: false,
                lb_low_33: false,
                lb_low_34: false,
                lb_low_35: false,
                lb_low_36: false,
                lb_low_37: false,
                lb_low_38: false,
                //labio-buccal lower operation
                lb_op_low_48: false,
                lb_op_low_47: false,
                lb_op_low_46: false,
                lb_op_low_45: false,
                lb_op_low_44: false,
                lb_op_low_43: false,
                lb_op_low_42: false,
                lb_op_low_41: false,
                lb_op_low_31: false,
                lb_op_low_32: false,
                lb_op_low_33: false,
                lb_op_low_34: false,
                lb_op_low_35: false,
                lb_op_low_36: false,
                lb_op_low_37: false,
                lb_op_low_38: false,
                //labio-buccal lower condition
                lb_cond_low_48: false,
                lb_cond_low_47: false,
                lb_cond_low_46: false,
                lb_cond_low_45: false,
                lb_cond_low_44: false,
                lb_cond_low_43: false,
                lb_cond_low_42: false,
                lb_cond_low_41: false,
                lb_cond_low_31: false,
                lb_cond_low_32: false,
                lb_cond_low_33: false,
                lb_cond_low_34: false,
                lb_cond_low_35: false,
                lb_cond_low_36: false,
                lb_cond_low_37: false,
                lb_cond_low_38: false,
                //labio-buccal lower
                lb_low_85: false,
                lb_low_84: false,
                lb_low_83: false,
                lb_low_82: false,
                lb_low_81: false,
                lb_low_71: false,
                lb_low_72: false,
                lb_low_73: false,
                lb_low_74: false,
                lb_low_75: false,
                //labio-buccal lower operation
                lb_op_low_85: false,
                lb_op_low_84: false,
                lb_op_low_83: false,
                lb_op_low_82: false,
                lb_op_low_81: false,
                lb_op_low_71: false,
                lb_op_low_72: false,
                lb_op_low_73: false,
                lb_op_low_74: false,
                lb_op_low_75: false,
                //labio-buccal lower condition
                lb_cond_low_85: false,
                lb_cond_low_84: false,
                lb_cond_low_83: false,
                lb_cond_low_82: false,
                lb_cond_low_81: false,
                lb_cond_low_71: false,
                lb_cond_low_72: false,
                lb_cond_low_73: false,
                lb_cond_low_74: false,
                lb_cond_low_75: false,

                dental_caries: 0,
                gingivitis: 0,
                periodontal_pocket: 0,
                debris: 0,
                calculus: 0,
                neoplasm: 0,
                dento_facial: 0,

                cnt_prst_teeth: null,
                cnt_indct_filing: null,
                cnt_indct_extraction: null,
                root_frgmt: null,
                cnt_mssng_due_caries: null,
                filled_restored: null,
                cnt_df_dmf: null,
                flouride_app: null,
            }),
            statuses: RecordStatus,
            wards: WardType,
            data: null,
            physicians: [],
            clients: [],
            or_nos: [],
            formTitle: null,
        };
    },
    methods: {
        onFocusClearError(field) {
            this.form.errors[field] = null;
        },
        computeAge() {
            const examination_date = new Date(this.form.examination_date);
            const today = new Date();
            let age = today.getFullYear() - examination_date.getFullYear();
            const month = today.getMonth() - examination_date.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < examination_date.getDate())) {
                age--;
            }else{
                age = null;
            }
            this.form.age_last_birthday = age;
        },
    },
    mounted() {
        this.physicians = this.$page.props.physicians.data;
        this.clients = this.$page.props.clients.data;
        this.or_nos = this.$page.props.or_nos.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Dental Record';
        }
        else {
            this.formTitle = 'Create Dental Record';
        }
    }
};
</script>

