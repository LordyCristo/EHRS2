<template>
<FormSection :data="data" :form="form" :action="action"
                 index-link="more.department.index"
                 :update-link="data? route('api.department.update', data.id): null"
                 :store-link="route('api.department.store')"
                 :delete-link="data? route('api.department.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <InputText v-model="form.name" label="Department Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
            <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
            <SelectElement v-model="form.college_id" label="College" :options="colleges" :errorMsg="form.errors.college_id" @input="form.errors['college_id'] = null" />
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import FormSection from "@/Components/Generic/Forms/FormSection.vue";
</script>
<script>
import { useForm } from "@inertiajs/vue3";
export default {
    props: {
        action: String,
    },
    data() {
        return {
            form: useForm({
                name: null,
                abbr: null,
                college_id: null,
            }),
            colleges: [],
            data: null,
            formTitle: null,
        };
    },
    mounted() {
        this.colleges = this.$page.props.colleges.data;
        if (this.action === 'update'){
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Department Details';
        }
        else {
            this.formTitle = 'Register New Department';
        }
    }
};
</script>
