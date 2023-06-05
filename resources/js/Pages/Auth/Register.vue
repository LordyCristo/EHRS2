<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import Checkbox from '@/Components/Checkbox.vue';
import RadioButton from '@/Components/RadioButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LandingNavBar from '@/Components/LandingNavBar.vue';
import LandingFooter from '@/Components/LandingFooter.vue';
import Select from '@/Components/Select.vue';
import InputField from "@/Components/Generic/Forms/InputField.vue";
</script>

<script>
export default {
    data() {
        return {
            currentSlide: 1,
            checkbox1: true,
            checkbox2: false,
            checkbox3: false,
            checkbox4: false,
            form: useForm({
                first_name: null,
                middle_name: null,
                last_name: null,
                suffix: null,
                birthdate: null,
                age: null,
                sex: null,
                mobile: null,
                telephone: null,
                role: null,
                specialization: null,
                license_no: null,
                position: null,
                email: null,
                password: null,
                password_confirmation: null,
                terms: true,
            }),
            roles: null,
        };
    },
    methods: {
        nextSlide() {
            if (this.currentSlide < 4) {
                if(this.currentSlide === 1){
                    this.form.errors.first_name = !this.form.first_name?'Required field':null;
                    this.form.errors.last_name = !this.form.last_name?'Required field':null;
                    if (!this.form.first_name || !this.form.last_name)
                        return;
                }else if (this.currentSlide === 2){
                    this.form.errors.birthdate = !this.form.birthdate?'Required field':null;
                    this.form.errors.age = !this.form.age?'Required field':null;
                    this.form.errors.sex = !this.form.sex?'Required field':null;
                    this.form.errors.mobile = !this.form.mobile?'Required field':null;
                    if (!this.form.birthdate || !this.form.age || !this.form.sex || !this.form.mobile)
                        return;
                }else{
                    this.form.errors.role = !this.form.role?'Required field':null;
                    this.form.errors.position = !this.form.position?'Required field':null;
                    if (!this.form.role || !this.form.position)
                        return;
                }
                this.currentSlide++;
                for (let i = 2; i <= this.currentSlide; i++) {
                    this['checkbox' + i] = true;
                }
            }
        },
        prevSlide() {
            if (this.currentSlide > 1) {
                this.currentSlide--;
                for (let i = this.currentSlide + 1; i <= 4; i++) {
                    this['checkbox' + i] = false;
                }
            }
        },
        updateSex(event) {
            this.form.sex = event.target.value;
        },
        computeAge() {
            const birthdate = new Date(this.form.birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            const month = today.getMonth() - birthdate.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            if(age)
                this.form.age = age.toString();
        },
        submit() {
            this.form.errors.email = !this.form.email?'Required field':null;
            this.form.errors.password = !this.form.password?'Required field':null;
            this.form.errors.password_confirmation = !this.form.password_confirmation?'Required field':null;
            if (!this.form.email || !this.form.password || !this.form.password_confirmation)
                return;
            console.log(this.form);
            this.form.post(route('register'), {
                onFinish: () => {
                    this.form.reset('password', 'password_confirmation');
                },
            });
        },
        clearForm(){
            this.form.reset();
            this.form.clearErrors();
        },
        roleChanged(event) {
            this.form.role = event.target.value;
        },
    },
    async mounted() {
        await axios.get(route('api.roles')).then((response) => {
            this.roles = response.data;
        });
    }
};
</script>


<template>
    <Head title="Register" />
    <landing-nav-bar></landing-nav-bar>
    <AuthenticationCard>
        <template #title>
            Creating New Account
        </template>

        <template #description>
            Please fill in the correct information.<br />
            <div class="flex">
                <span class="text-red-600 mx-auto text-xs">*USHER staffs only*</span>
            </div>
        </template>

        <div class="flex flex-row justify-center gap-3 mb-2">
            <checkbox :disabled="true" :checked="checkbox1" name="step1"></checkbox>
            <checkbox :disabled="true" :checked="checkbox2" name="step2"></checkbox>
            <checkbox :disabled="true" :checked="checkbox3" name="step3"></checkbox>
            <checkbox :disabled="true" :checked="checkbox4" name="step4"></checkbox>
        </div>
        <form @submit.prevent="submit">
            <div id="carousel-1" v-show="currentSlide === 1">
                <InputField name="first_name" :errorMsg="form.errors.first_name" label="First Name" :required="true">
                    <TextInput id="first_name" v-model="form.first_name" name="first_name" type="text"
                               class="mt-1 block w-full" autofocus autocomplete="name" />
                </InputField>
                <InputField name="middle_name" :errorMsg="form.errors.middle_name" label="Middle Name" class="mt-4">
                    <TextInput id="middle_name" v-model="form.middle_name" name="middle_name" type="text"
                               class="mt- block w-full" autofocus autocomplete="name" />
                </InputField>
                <InputField name="last_name" :errorMsg="form.errors.last_name" label="Last Name" class="mt-4" :required="true">
                    <TextInput id="last_name" v-model="form.last_name" name="last_name" type="text"
                               class="mt-1 block w-full" autofocus autocomplete="name" />
                </InputField>
                <InputField name="suffix" :errorMsg="form.errors.suffix" label="Suffix" class="mt-4">
                    <TextInput id="suffix" v-model="form.suffix" name="suffix" type="text"
                               class="mt-1 block w-full" autofocus autocomplete="name" />
                </InputField>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton type="button" @click.prevent="clearForm()"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Cancel
                    </SecondaryButton>
                    <PrimaryButton @click="nextSlide" type="button"
                        class="bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-white focus:ring-vsu-green">
                        Next
                    </PrimaryButton>
                </div>
                <div class="mt-3">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                    </Link>
                </div>
            </div>
            <div id="carousel-2" v-show="currentSlide === 2">
                <InputField name="birthdate" :errorMsg="form.errors.birthdate" label="Birthdate" :required="true">
                    <TextInput id="birthdate" name="birthdate" v-model="form.birthdate" type="date" @change="computeAge"
                               class="mt-1 block w-full" autofocus autocomplete="birthday" />
                </InputField>
                <div class="grid grid-cols-2 gap-3">
                    <InputField name="age" :errorMsg="form.errors.age" label="Age" class="mt-4" :required="true">
                        <TextInput id="age" name="age" v-model.number="form.age" type="number" class="mt-1 block w-full" autocomplete="age" />
                    </InputField>
                    <InputField name="sex" :errorMsg="form.errors.sex" label="Sex" class="mt-4" :required="true">
                        <div class="flex flex-row items-center justify-center gap-5 mt-3">
                            <radio-button id="sex-male" name="sex" v-model="form.sex" value="male"
                                          @change="updateSex">Male</radio-button>
                            <radio-button id="sex-female" name="sex" v-model="form.sex" value="female"
                                          @change="updateSex">Female</radio-button>
                        </div>
                    </InputField>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <InputField name="mobile" :errorMsg="form.errors.mobile" label="Mobile" class="mt-4" :required="true">
                        <TextInput id="mobile" name="mobile" v-model="form.mobile" type="number" class="mt-1 block w-full" autocomplete="mobile" />
                    </InputField>
                    <InputField name="telephone" :errorMsg="form.errors.telephone" label="Landline" class="mt-4">
                        <TextInput id="telephone" name="telephone" v-model="form.telephone" type="number" class="mt-1 block w-full" autocomplete="telephone" />
                    </InputField>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton @click="prevSlide"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Back
                    </SecondaryButton>
                    <PrimaryButton @click="nextSlide" type="button"
                        class="bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-white focus:ring-vsu-green">
                        Next
                    </PrimaryButton>
                </div>
                <div class="mt-3">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                    </Link>
                </div>
            </div>
            <div id="carousel-3" v-show="currentSlide === 3">
                <InputField name="role" :errorMsg="form.errors.role" label="Role Access" :required="true">
                    <Select v-model="form.role" autofocus id="role" :data="roles" @change="roleChanged" name="role" class="mt-1 block w-full" />
                </InputField>
                <InputField name="specialization" :errorMsg="form.errors.specialization" label="Specialization" class="mt-4">
                    <TextInput id="specialization" name="specialization" v-model="form.specialization" type="text"
                               class="mt-1 block w-full" autocomplete="specialization" />
                </InputField>
                <InputField name="license_no" :errorMsg="form.errors.license_no" label="License Number" class="mt-4" :required="true">
                    <TextInput id="license_no" name="license_no" v-model="form.license_no" type="text"
                               class="mt-1 block w-full" autocomplete="license_no" />
                </InputField>
                <InputField name="position" :errorMsg="form.errors.position" label="Position" class="mt-4" :required="true">
                    <TextInput id="position" name="position" v-model="form.position" type="text"
                               class="mt-1 block w-full" autocomplete="position" />
                </InputField>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton @click="prevSlide"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Back
                    </SecondaryButton>
                    <PrimaryButton @click="nextSlide" type="button"
                        class="bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-white focus:ring-vsu-green">
                        Next
                    </PrimaryButton>
                </div>
                <div class="mt-3">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                    </Link>
                </div>
            </div>
            <div id="carousel-4" v-show="currentSlide === 4">
                <InputField name="email" :errorMsg="form.errors.email" label="Email" class="mt-4" :required="true">
                    <TextInput id="email" name="email" v-model="form.email" type="text" class="mt-1 block w-full" autocomplete="username" />
                </InputField>
                <InputField name="password" :errorMsg="form.errors.password" label="Password" class="mt-4" :required="true">
                    <TextInput id="password" name="password" v-model="form.password" type="password"
                               class="mt-1 block w-full" autocomplete="new-password" />
                </InputField>
                <InputField name="password_confirmation" :errorMsg="form.errors.password_confirmation" label="Confirm Password" class="mt-4" :required="true">
                    <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                               class="mt-1 block w-full" autocomplete="new-password" />
                </InputField>
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms
                                    of Service</a> and <a target="_blank" :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy
                                    Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <SecondaryButton @click="prevSlide"
                        class="hover:text-white hover:bg-vsu-olive focus:bg-vsu-olive active:bg-vsu-olive active:text-white focus:ring-vsu-olive">
                        Back
                    </SecondaryButton>
                    <PrimaryButton type="submit"
                        class="ml-4 bg-vsu-green hover:bg-vsu-olive focus:bg-vsu-green active:bg-vsu-olive active:text-vsu-green focus:ring-vsu-green"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
                <div class="mt-3">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                    </Link>
                </div>
            </div>
        </form>
    </AuthenticationCard>
    <landing-footer></landing-footer>
</template>
