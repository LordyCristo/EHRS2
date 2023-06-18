<script setup>
import Clients from '@/Pages/Clients.vue';
import DataTable from '@/Components/DataTable/DataTable.vue';
import {toJSON} from "yaml/util";
import {isNull} from "pdfmake/src/helpers";
import { Link } from "@inertiajs/vue3";
import { pushNotification } from "@/Components/Generic/Modals/NotifBanner.vue";
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
        <div class="grid grid-cols-5 gap-2 h-fit">
            <div v-for="user in data" class="bg-gray-200 shadow-md rounded-md p-5 border">
                <div>
                    <div>
                        <span class="font-bold">Approval ID:</span> {{ user.id }}
                    </div>
                    <div>
                        <span class="font-bold">Name:</span> {{ stringToJSON(user.new_data).first_name }} {{ stringToJSON(user.new_data).middle_name?.charAt(0) }} {{ stringToJSON(user.new_data).last_name }}
                    </div>
                    <div>
                        <span class="font-bold">Email:</span> {{ stringToJSON(user.new_data).email }}
                    </div>
                    <div>
                        <span class="font-bold">License No.:</span> {{ stringToJSON(user.new_data).license_no }}
                    </div>
                    <div>
                        <span class="font-bold">Birthdate:</span> {{ stringToJSON(user.new_data).birthdate }}
                    </div>
                    <div>
                        <span class="font-bold">Specialization:</span> {{ stringToJSON(user.new_data).specialization }}
                    </div>
                    <div>
                        <span class="font-bold">Status:</span> {{ user.state }}
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-3">
                    <button @click="reject(user.id)" class="bg-red-200 py-0.5 px-1 hover:scale-110 active:scale-95 rounded-md shadow text-red-700">Reject</button>
                    <button @click="approve(user.id)"  class="bg-vsu-green py-0.5 px-1 hover:scale-110 active:scale-95 rounded-md shadow text-white">Approve</button>
                </div>
            </div>
        </div>
    </div>
    </Clients>
</template>
