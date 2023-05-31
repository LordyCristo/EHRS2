<template>
    <Finance title="Create Form">
        <div class="flex justify-center h-full w-full">
            <div class="max-w-fit sm:p-5 p-1 rounded-sm">
                <div class="flex items-center justify-end mb-3 gap-2">
                    <Link :href="route('finance.payment.index')" class="text-gray-600 hover:text-gray-900 duration-300">
                        <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                    </Link>
                </div>
                <div id="official-receipt-printable" class="shadow-xl px-5 py-8 mx-auto max-w-xl">
                    <div class="inline-flex text-center justify-center mb-1 gap-1">
                        <img src="../../../Components/Icons/vsu-name-logo.png" alt="Visayas State University Logo" class="w-[15rem] h-auto">
                        <h1 class="text-right m-0 p-0 font-bold text-sm font-montserrat">
                            OFFICE OF THE CHIEF OF UNIVERSITY SERVICES FOR HEALTH EMERGENCY AND RESCUE (USHER)
                        </h1>
                    </div>
                    <template v-if="data">
                        <div>
                            <h2 class="font-montserrat font-bold text-center text-lg mb-4 p-0">
                                OFFICIAL RECEIPT
                            </h2>
                        </div>
                        <div v-if="data">
                            <div class="flex justify-between">
                                <span class="w-full"><b>OR No. </b>{{ data.id }}</span>
                                <span class="w-full"><b>Date Issued:</b> {{ new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="w-full"><b>Payor Name: </b>{{ data.payor_name }}</span>
                                <span class="w-full"><b>Payor Email: </b>{{ data.payor_email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="w-full"><b>Infirmary No.: </b>{{ data.client.infirmary_id }}</span>
                                <span class="w-full"><b>Payor Contact: </b>{{ data.payor_mobile }}</span>
                            </div>
                            <div class="grid grid-cols-2 mt-3 border-y-2">
                                <div class="font-bold text-center">Service Name</div>
                                <div class="font-bold text-center">Amount</div>
                            </div>
                            <template v-if="data.paid_services">
                                <div v-for="srvc in data.paid_services" :key="srvc.id" class="grid grid-cols-2 mt-1 px-2">
                                    <span class="w-full">{{ srvc.service?srvc.service.service.name:'Unable to retrieve service name' }}</span>
                                    <span class="w-full text-center">&#x20B1;{{ srvc.fee?srvc.fee:'Unable to retrieve service fee' }}</span>
                                </div>
                            </template>
                            <template v-else>
                                <span>Unable to retrieve paid services</span>
                            </template>
                            <div class="grid grid-cols-2 mt-2 px-2 border-y">
                                <span class=" font-bold">Total Amount</span>
                                <span class="w-full text-center">&#x20B1;{{ data.total_amount }}</span>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-center font-bold">
                            <span>Unable to generate receipt</span>
                        </div>
                    </template>
                </div>
                <div class="flex justify-end mt-3">
                    <button @click="printForm" class="py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-90 hover:bg-vsu-olive">Print</button>
                </div>
            </div>
        </div>
    </Finance>
</template>
<script setup>
import Finance from "@/Pages/Finance.vue";
import {Link} from "@inertiajs/vue3";
import BackIcon from "@/Components/Icons/BackIcon.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import VSULogoName from "@/Components/Icons/VSULogoName.vue";

const printForm = () => {
    const printableContent = document.getElementById('official-receipt-printable');
    if (printableContent) {
        console.log(printableContent);
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Print Form</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
                    <style>
                        @media print {
                            @page {
                                size: A4;
                                margin: 0;
                            }
                            body {
                                margin: 1.6cm;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${printableContent.innerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };
    }
};

</script>
<script>
export default {
    data: () => ({
        data: null,
    }),
    mounted() {
        this.data = this.$page.props.data.data;
    },
    methods: {
        printComponent() {
            // Create a new HTML canvas element
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Get the component's HTML element
            const componentElement = this.$el;

            // Set the canvas dimensions to match the component's size
            canvas.width = componentElement.offsetWidth;
            canvas.height = componentElement.offsetHeight;

            // Draw the component's content onto the canvas
            context.drawComponent(componentElement);

            // Convert the canvas content to a base64-encoded image URL
            const imageURL = canvas.toDataURL('image/png');

            // Create a new window or tab with the printable image
            const printWindow = window.open();
            printWindow.document.write(`<img src="${imageURL}" />`);
            printWindow.document.close();

            // Trigger the print dialog for the new window/tab
            printWindow.print();
        }
    }
}
</script>
