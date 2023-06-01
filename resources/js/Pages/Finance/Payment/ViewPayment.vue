<template>
    <Finance title="Create Form">
        <ViewForm :link="route('finance.payment.index')" >
            <div class="printTable flex flex-col">
                <div class="inline-flex text-center justify-between mb-1 gap-1">
                    <img src="../../../Components/Icons/vsu-name-logo.png" alt="Visayas State University Logo" class="vsu-logo w-[15rem] h-auto">
                    <h1 class="header-text text-right m-0 p-0 font-bold text-sm font-montserrat max-w-xs">
                        OFFICE OF THE CHIEF OF UNIVERSITY SERVICES FOR HEALTH EMERGENCY AND RESCUE (USHER)
                    </h1>
                </div>
                <template v-if="data">
                    <div class="text-center font-bold text-xl uppercase my-3">
                        <h2 class="form-title">OFFICIAL RECEIPT</h2>
                    </div>
                    <div v-if="data">
                        <div class="flex justify-between">
                            <span class="w-full whitespace-nowrap"><b>OR No. </b>{{ data.id }}</span>
                            <span class="w-full whitespace-nowrap"><b>Date Issued:</b> {{ new Date(data.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="w-full whitespace-nowrap"><b>Payor Name: </b>{{ data.payor_name }}</span>
                            <span class="w-full whitespace-nowrap"><b>Payor Email: </b>{{ data.payor_email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="w-full whitespace-nowrap"><b>Infirmary No.: </b>{{ data.client.infirmary_id }}</span>
                            <span class="w-full whitespace-nowrap"><b>Payor Contact: </b>{{ data.payor_mobile }}</span>
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
        </ViewForm>
    </Finance>
</template>
<script setup>
import Finance from "@/Pages/Finance.vue";
import ViewForm from "@/Components/Generic/Forms/ViewForm.vue";
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
