<script setup>
import Record from '@/Pages/MedicalRecords.vue';
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Generic/Forms/SelectElement.vue';
</script>

<script>
export default {
    data() {
        return {
            form: useForm({
                name: null,
                abbr: null,
                major: null,
                department_id: null,
            }),
            department_ids: ref([]),
        };
    },
    methods: {
        submit() {
            this.form.post(route('api.department.store'), {
                onSuccess: () => {
                    this.clearForm();
                },
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clearErrors();
        }
    },
    mounted() {
        axios.get(route('api.departments'))
            .then(response => {
                this.department_ids = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
};
</script>

<template>
    <Record>
        <Head title="Register" />
        <div class="container max-w-2xl mx-auto">
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Program Description" />
                    <TextInput id="name" v-model="form.name" name="name" type="text" class="mt-1 block w-full" autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="abbr" value="Abbreviation" />
                    <TextInput id="abbr" name="abbr" v-model="form.abbr" type="text" class="mt-1 block w-full"
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.abbr" />
                </div>

                <div class="mt-4">
                    <InputLabel for="major" value="Major" />
                    <TextInput id="major" name="major" v-model="form.major" type="text" class="mt-1 block w-full"
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.major" />
                </div>
                <div>
                    <InputLabel for="department_id" value="Department" />
                    <Select v-model="form.department_id" id="department_id" name="department_id" :options="department_ids"
                        class="mt-1 block w-full"></Select>
                    <InputError class="mt-2" :message="form.errors.department_id" />
                </div>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton type="button" @click="clearForm"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Clear
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
