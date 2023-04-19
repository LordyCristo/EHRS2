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

// const form = useForm({
//     first_name: 'Cristo',
//     middle_name: null,
//     last_name: 'Magdadaro',
//     suffix: null,
//     birthdate: '2000-11-22',
//     age: '23',
//     sex: 'MALE',
//     mobile: null,
//     landline: null,
//     role: '2',
//     specialization: null,
//     license:null,
//     position:'Chief Officer II',
//     email: 'admin@admin.com',
//     password: '11221122',
//     password_confirmation: '11221122',
//     terms: true,
// });

const roles = ref(Array);
onMounted(async () => {
    try {
        const response = await fetch(route('api.roles'), { method: 'GET' }); // replace with the actual API endpoint for retrieving roles
        const data = await response.json();
        roles.value = data;
    } catch (error) {
        console.error(error);
    }
});

</script>

<script>
export default {
    data() {
        return {
            currentSlide: 1,
            checkbox1: false,
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
                landline: null,
                role: null,
                specialization: null,
                license: null,
                position: null,
                email: null,
                password: null,
                password_confirmation: null,
                terms: true,
            })
        };
    },
    methods: {
        nextSlide() {
            if (this.currentSlide < 4) {
                this.currentSlide++;
                for (let i = 1; i < this.currentSlide; i++) {
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
            console.log(this.form.sex);
        },
        submit() {
            console.log(this.form);
            this.form.post(route('register'), {
                onFinish: () => {
                    console.log(this.form.errors);
                    this.form.reset('password', 'password_confirmation');
                },
            });
        },
        clearForm(){
            this.form.reset();
            this.form.clearErrors();
        }
    },
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
                <div>
                    <InputLabel for="first_name" value="First Name" />
                    <TextInput id="first_name" v-model="form.first_name" name="first_name" type="text"
                        class="mt-1 block w-full" autofocus autocomplete="name" @click="" />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="middle_name" value="Middle Name" />
                    <TextInput id="middle_name" name="middle_name" v-model="form.middle_name" type="text"
                        class="mt-1 block w-full" autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.middle_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="last_name" value="Last Name" />
                    <TextInput id="last_name" name="last_name" v-model="form.last_name" type="text"
                        class="mt-1 block w-full" autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="suffix" value="Suffix" />
                    <TextInput id="suffix" name="suffix" v-model="form.suffix" type="text" class="mt-1 block w-full"
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.suffix" />
                </div>
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
                <div>
                    <InputLabel for="birthdate" value="Birthdate" />
                    <TextInput id="birthdate" name="birthdate" v-model="form.birthdate" type="date"
                        class="mt-1 block w-full" autofocus autocomplete="birthday" />
                    <InputError class="mt-2" :message="form.errors.birthdate" />
                </div>

                <div class="flex">
                    <div class="mt-4">
                        <InputLabel for="age" value="Age" />
                        <TextInput id="age" name="age" v-model="form.age" type="number" class="mt-1 block w-full"
                            autocomplete="age" />
                        <InputError class="mt-2" :message="form.errors.age" />
                    </div>

                    <div class="mt-4 ml-4">
                        <InputLabel for="sex" value="Sex" />
                        <div class="flex flex-row justify-center gap-5">
                            <radio-button id="sex-male" name="sex" v-model="form.sex" value="MALE"
                                @change="updateSex">Male</radio-button>
                            <radio-button id="sex-female" name="sex" v-model="form.sex" value="FEMALE"
                                @change="updateSex">Female</radio-button>
                        </div>
                        <InputError class="mt-2" :message="form.errors.sex" />
                    </div>
                </div>

                <div class="mt-4">
                    <InputLabel for="mobile" value="Mobile Number" />
                    <TextInput id="mobile" name="mobile" v-model="form.mobile" type="number" class="mt-1 block w-full"
                        autocomplete="mobile" />
                    <InputError class="mt-2" :message="form.errors.mobile" />
                </div>

                <div class="mt-4">
                    <InputLabel for="landline" value="Landline" />
                    <TextInput id="landline" name="landline" v-model="form.landline" type="tel" class="mt-1 block w-full"
                        autocomplete="landline" />
                    <InputError class="mt-2" :message="form.errors.landline" />
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
                <div>
                    <InputLabel for="role" value="Role" />
                    <Select v-model="form.role" autofocus id="role" name="role" class="mt-1 block w-full">
                        <template #options>
                            <option value="" hidden select>Choose</option>
                            <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name }}</option>
                        </template>
                    </Select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <div class="mt-4">
                    <InputLabel for="specialization" value="Specialization" />
                    <TextInput id="specialization" name="specialization" v-model="form.specialization" type="text"
                        class="mt-1 block w-full" autocomplete="specialization" />
                    <InputError class="mt-2" :message="form.errors.specialization" />
                </div>

                <div class="mt-4">
                    <InputLabel for="license" value="License Number" />
                    <TextInput id="license" name="license" v-model="form.license" type="text" class="mt-1 block w-full"
                        autocomplete="license" />
                    <InputError class="mt-2" :message="form.errors.license" />
                </div>

                <div class="mt-4">
                    <InputLabel for="position" value="Position" />
                    <TextInput id="position" name="position" v-model="form.position" type="text" class="mt-1 block w-full"
                        autocomplete="position" />
                    <InputError class="mt-2" :message="form.errors.position" />
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
            <div id="carousel-4" v-show="currentSlide === 4">
                <div class="mt-4">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <TextInput id="email" name="email" v-model="form.email" type="text" class="mt-1 block w-full"
                        autocomplete="username" />

                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" name="password" v-model="form.password" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

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
