<script setup>
import Record from '@/Pages/MedicalRecords.vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputText from '@/Components/Generic/Forms/InputText.vue';
import Select from '@/Components/Generic/Forms/SelectElement.vue';
</script>

<script>
export default {
    props: {
        department_ids: Object,
    },
    data() {
        return {
            form: useForm({
                name: null,
                abbr: null,
                major: null,
                department_id: 0,
            }),
        };
    },
    methods: {
        submit() {
            // this.form.post(route('api.program.store'), {
            //     onSuccess: () => {
            //         this.clearForm();
            //     },
            // });

        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        }
    },
};
</script>

<template>
    <Record>
        <Head title="Register" ><title>Register</title></Head>
        <div class="container max-w-2xl mx-auto">
            <form @submit.prevent="submit">
                <InputText v-model="form.name" label="Program Description" :errorMsg="form.errors.name" autofocus @input="form.errors['name'] = null" />
                <InputText v-model="form.abbr" label="Abbreviation" :errorMsg="form.errors.abbr" autofocus @input="form.errors['abbr'] = null" />
                <InputText v-model="form.major" label="Major" :errorMsg="form.errors.major" autofocus @input="form.errors['major'] = null" />
                <Select v-model="form.department_id" label="Department" :options="department_ids" :errorMsg="form.errors.department_id" @input="form.errors['department_id'] = null" />
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton type="button" @click="clearForm"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Clears
                    </SecondaryButton>
                    <PrimaryButton type="submit"
                        class="ml-4 bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-vsu-green focus:ring-vsu-green"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Record>
</template>
