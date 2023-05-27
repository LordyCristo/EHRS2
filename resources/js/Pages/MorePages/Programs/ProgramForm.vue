<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="more.program.index"
                 :update-link="data? route('api.program.update', data.id): null"
                 :store-link="route('api.program.store')"
                 :delete-link="data? route('api.program.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <InputText v-model="form.name" label="Degree Program Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
            <InputText v-model="form.major" label="Major" :errorMsg="form.errors.major" @input="form.errors['major'] = null" />
            <SelectElement v-model="form.department_id" label="College" :options="departments" :errorMsg="form.errors.department_id" @input="form.errors['department_id'] = null" />
            <div class="grid grid-cols-2">
                <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
                <SelectElement v-model="form.group" label="Group" :options="groups" :errorMsg="form.errors.group" @input="form.errors['group'] = null" />
            </div>
            <RadioButton v-model="form.is_active" label="Status" :options="statuses" :errorMsg="form.errors.is_active" @input="form.errors['is_active'] = null" />
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
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
                is_active: null,
            }),
            statuses: [
                {id: 1, name: 'Active'},
                {id: 0, name: 'Inactive'},
            ],
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
            this.form.is_active = 1;
            this.formTitle = 'Register New Degree Program';
        }
    }
};
</script>
