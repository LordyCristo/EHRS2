<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="more.college.index"
                 :update-link="data? route('api.college.update', data.id): null"
                 :store-link="route('api.college.store')"
                 :delete-link="data? route('api.college.destroy', data.id): null"
    >
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <InputText v-model="form.name" label="College Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
            <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" @input="form.errors['abbr'] = null" />
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
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
            }),
            data: null,
            formTitle: null,
        };
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update College';
        }
        else {
            this.formTitle = 'Register New College';
        }
    }
};
</script>
