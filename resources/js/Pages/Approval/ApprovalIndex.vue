<script setup>
import Clients from '@/Pages/Clients.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';
import {toJSON} from "yaml/util";
import {isNull} from "pdfmake/src/helpers";
import { Link } from "@inertiajs/vue3";
import { pushNotification } from "@/Components/Generic/Modals/NotifBanner.vue";
import DisplayValue from "@/Components/Generic/Forms/DisplayValue.vue";
import ViewField from "@/Components/Generic/Forms/ViewField.vue";
</script>
<script>
import axios from "axios";

export default {
    data: () => ({
        data: [],
        apiLink:{
            approve: 'api.user.approve',
            reject: 'api.user.reject',
        }
    }),
    methods: {
        async fetchData() {
            const { data } = await axios.get(route('api.user.approval'));
            this.data = data;
        },
        stringToJSON(data) {
            return JSON.parse(data);
        },
        async approve(id) {
            console.log('waiting for approval');
            await axios.put(route('api.user.approve', { id: id }))
                .then(response => {
                    this.fetchData();
                    pushNotification(response.data.notification);
                    console.log('approved');
                })
                .catch(error => {
                    console.error(error);
                });
        },
        async reject(id) {
            await axios.put(route('api.user.reject',  { id: id }))
                .then(response => {
                    this.fetchData();
                    pushNotification(response.data.notification);
                });
        },
        formatName(data) {
            return data.first_name + ' ' + data.middle_name + ' ' + data.last_name;
        }
    },
    mounted() {
        this.fetchData();
    },
}
</script>

<template>
    <Clients title="Client Records">
    <div class="flex flex-col w-full">
        <h1 class="font-bold uppercase mb-3 text-xl">New Users that needs approval</h1>
        <div class="grid grid-cols-3 gap-3 h-fit">
            <template v-if="data.length" v-for="user in data">
                <div class="bg-gray-200 shadow-md rounded-md p-5 border">
                    <div class="min-h-[12rem]">
                        <ViewField  label="Approval ID" :value="user.id" />
                        <ViewField  label="Name" :value="formatName(stringToJSON(user.new_data))" />
                        <ViewField  label="Email" :value="stringToJSON(user.new_data).email" />
                        <ViewField  label="License No." :value="stringToJSON(user.new_data).license_no" />
                        <ViewField  label="Birthdate" :value="stringToJSON(user.new_data).birthdate" />
                        <ViewField  label="Specialization" :value="stringToJSON(user.new_data).specialization" />
                        <ViewField  label="State" :value="user.state" />
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <button @click="reject(user.id)" class="bg-red-200 py-0.5 px-1 hover:scale-110 active:scale-95 rounded-md shadow text-red-700">Reject</button>
                        <button @click="approve(user.id)"  class="bg-vsu-green py-0.5 px-1 hover:scale-110 active:scale-95 rounded-md shadow text-white">Approve</button>
                    </div>
                </div>
            </template>
            <div v-else>
                <span>No pending user approval</span>
            </div>
        </div>
    </div>
    </Clients>
</template>
