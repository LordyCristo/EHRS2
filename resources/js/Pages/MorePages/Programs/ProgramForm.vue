<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="more.program.index"
                 :update-link="data? route('api.program.update', data.id): null"
                 :store-link="route('api.program.store')"
                 :delete-link="data? route('api.program.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <InputText v-model="form.name" label="Degree Program Name" required :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
            <InputText v-model="form.major" label="Major" :errorMsg="form.errors.major" @input="form.errors['major'] = null" />
            <InputTextAuto v-model="form.department_id" label="Department" required :options="departments" :errorMsg="form.errors.department_id" @input="form.errors['department_id'] = null" />
            <div class="grid grid-cols-2">
                <InputText v-model="form.abbr" label="Abbreviation" required :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
                <SelectElement v-model="form.group" label="Group" required :options="groups" :errorMsg="form.errors.group" @input="form.errors['group'] = null" />
            </div>
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
import InputTextAuto from "@/Components/Generic/Forms/InputTextAuto.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
import { AcademicGroup } from "@/Legends/legends.ts";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                name: null,
                abbr: null,
                major: null,
                group: null,
                department_id: null,
            }),
            departments: [],
            data: null,
            formTitle: null,
            groups: AcademicGroup,
        };
    },
    mounted() {
        this.departments = this.$page.props.departments.data;
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Degree Program Details';
        }
        else {
            this.formTitle = 'Register New Degree Program';
        }
    }
};
</script>
