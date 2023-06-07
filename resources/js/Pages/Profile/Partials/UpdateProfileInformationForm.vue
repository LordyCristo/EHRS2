<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/Generic/Forms/InputText.vue';
import Datepicker from "@/Components/Generic/Forms/Datepicker.vue";
import SelectElement from "@/Components/Generic/Forms/SelectElement.vue";
import InputField from "@/Components/Generic/Forms/InputField.vue";
import RadioButton from "@/Components/Generic/Forms/RadioButton.vue";
import InputText from "@/Components/Generic/Forms/InputText.vue";
const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    first_name: props.user.first_name,
    middle_name: props.user.middle_name,
    last_name: props.user.last_name,
    suffix: props.user.suffix,
    birthdate: props.user.birthdate,
    age: props.user.age,
    sex: props.user.sex,
    role: props.user.role,
    specialization: props.user.specialization,
    curr_position: props.user.curr_position,
    license_no: props.user.license_no,
    telephone: props.user.telephone,
    mobile: props.user.mobile,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    console.log(form.data());
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
    console.log(form.errors);
};

const updateSex = (event) => {
    form.sex = event.target.value;
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
<!--            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">-->
<!--                &lt;!&ndash; Profile Photo File Input &ndash;&gt;-->
<!--                <input ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview">-->

<!--                <InputLabel for="photo" value="Photo" />-->

<!--                &lt;!&ndash; Current Profile Photo &ndash;&gt;-->
<!--                <div v-show="!photoPreview" class="mt-2">-->
<!--                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">-->
<!--                </div>-->

<!--                &lt;!&ndash; New Profile Photo Preview &ndash;&gt;-->
<!--                <div v-show="photoPreview" class="mt-2">-->
<!--                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"-->
<!--                        :style="'background-image: url(\'' + photoPreview + '\');'" />-->
<!--                </div>-->

<!--                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">-->
<!--                    Select A New Photo-->
<!--                </SecondaryButton>-->

<!--                <SecondaryButton v-if="user.profile_photo_path" type="button" class="mt-2" @click.prevent="deletePhoto">-->
<!--                    Remove Photo-->
<!--                </SecondaryButton>-->

<!--                <InputError :message="form.errors.photo" class="mt-2" />-->
<!--            </div>-->

            <!-- Name -->
            <div class="col-span-6 sm:col-span-6">
                <div class="flex sm:flex-row flex-col">
                    <TextInput id="first_name" :required="true" v-model="form.first_name" label="First Name" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="first_name" :errorMsg="form.errors.first_name" />
                    <TextInput id="middle_name" v-model="form.middle_name" label="Middle Name" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="middle_name" :errorMsg="form.errors.middle_name" />
                    <TextInput id="last_name" :required="true" v-model="form.last_name" label="Last Name" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="last_name" :errorMsg="form.errors.last_name" />
                    <TextInput id="suffix" v-model="form.suffix" label="Suffix" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="suffix" :errorMsg="form.errors.suffix" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <div class="flex sm:flex-row flex-col">
                    <Datepicker id="birthdate" v-model="form.birthdate" :required="true" label="Birthdate" class="mt-1 mr-1 block w-full"
                        autocomplete="birthdate" :errorMsg="form.errors.suffix" />
                    <TextInput id="age" v-model="form.age" :required="true" label="Age" type="text" class="mt-1 mr-1 block w-full"
                       autocomplete="age" :errorMsg="form.errors.age" />
                    <InputField name="sex" :errorMsg="form.errors.sex" label="Sex" class="mt-4" :required="true">
                        <div class="flex flex-row items-center justify-center gap-5 mt-3">
                            <radio-button id="sex-male" name="sex" v-model="form.sex" value="male"
                                          @change="updateSex">Male</radio-button>
                            <radio-button id="sex-female" name="sex" v-model="form.sex" value="female"
                                          @change="updateSex">Female</radio-button>
                        </div>
                    </InputField>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <div class="flex sm:flex-row flex-col">
                    <InputText id="specialization" v-model="form.specialization" label="Specialization" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="specialization" :errorMsg="form.errors.specialization" />
                    <InputText id="curr_position" v-model="form.curr_position" :required="true" label="Current Position" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="curr_position" :errorMsg="form.errors.curr_position" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <div class="flex sm:flex-row flex-col">
                    <InputText id="license_no" v-model="form.license_no" label="License No." type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="license_no" :errorMsg="form.errors.license_no" />
                    <InputText id="telephone" v-model="form.telephone" label="Telephone" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="telephone" :errorMsg="form.errors.telephone" />
                    <InputText id="mobile" v-model="form.mobile" :required="true" label="Mobile" type="text" class="mt-1 mr-1 block w-full"
                        autocomplete="mobile" :errorMsg="form.errors.mobile" />
                </div>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputText id="email" v-model="form.email" label="Email" :required="true" type="email" :errorMsg="form.errors.email"  class="mt-1 block w-full" autocomplete="username" />
<!--                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">-->
<!--                    <p class="text-sm mt-2">-->
<!--                        Your email address is unverified.-->
<!--                        <Link :href="route('verification.send')" method="post" as="button"-->
<!--                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                            @click.prevent="sendEmailVerification">-->
<!--                        Click here to re-send the verification email.-->
<!--                        </Link>-->
<!--                    </p>-->
<!--                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">-->
<!--                        A new verification link has been sent to your email address.-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
