<template>
    <FormSection :data="data" :form="form" :action="action"
                 index-link="more.service.index"
                 :update-link="data? route('api.service.update', data.id): null"
                 :store-link="route('api.service.store')"
                 :delete-link="data? route('api.service.destroy', data.id): null">
        <template #formTitle>{{ formTitle }}</template>
        <template #formBody>
            <InputText v-model="form.name" label="Service Name" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
            <InputText v-model="form.description" label="Description" :errorMsg="form.errors.description" @input="form.errors['description'] = null" />
            <InputText v-model="form.schedule" label="Schedule" :errorMsg="form.errors.schedule" @input="form.errors['schedule'] = null" />
            <div class="grid grid-cols-2">
                <InputText v-model="form.section_name" label="Section Name" :errorMsg="form.errors.section_name" @input="form.errors['section_name'] = null" />
                <InputText v-model="form.room_no" label="Room No" :errorMsg="form.errors.room_no" @input="form.errors['room_no'] = null" />
            </div>
            <RadioButton v-model="form.is_active" label="Status" :options="statuses" :errorMsg="form.errors.is_active" @input="form.errors['is_active'] = null" />
        </template>
    </FormSection>
</template>
<script setup>
import InputText from "@/Components/Generic/Forms/InputText.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
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
                description: null,
                schedule: null,
                section_name: null,
                room_no: null,
                is_active: null,
            }),
            statuses: [
                {id: 1, name: 'Active'},
                {id: 0, name: 'Inactive'},
            ],
            data: null,
            formTitle: null,
        };
    },
    mounted() {
        if (this.action === 'update') {
            this.data = this.$page.props.data.data;
            this.form = useForm(this.data);
            this.formTitle = 'Update Service';
        }
        else {
            this.form.is_active = 1;
            this.formTitle = 'Register New Service';
        }
    }
};
</script>
