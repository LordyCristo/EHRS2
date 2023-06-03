<template>
    <div class="flex flex-col justify-center h-full w-fit mx-auto">
        <div class="flex items-center justify-end mb-3 gap-2">
            <Link :href="props.link" class="text-gray-600 hover:text-gray-900 duration-300" title="Close">
                <CloseIcon class="w-7 h-auto hover:rotate-90 duration-300" />
            </Link>
        </div>
        <div id="official-receipt-printable" class="printTable shadow-2xl px-10 py-15 mx-auto max-w-fit">
            <slot />
        </div>
        <div class="fixed bottom-5 right-5">
            <button @click="printForm" class="flex items-center gap-1 py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-90 hover:bg-vsu-olive">
                <PrintIcon class="w-5 h-auto text-white" />
                Print
            </button>
        </div>
    </div>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import PrintIcon from "@/Components/Icons/PrintIcon.vue";
const props = defineProps({
    link: {
        type: String,
        required: true,
    },
});

const printForm = () => {
    const printableContent = document.getElementById('official-receipt-printable');
    if (printableContent) {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Print Form</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap');
                        @media print {
                            @page {
                                size: A4;
                                margin: 0;
                            }
                            body {
                                margin: 0.8cm;
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
