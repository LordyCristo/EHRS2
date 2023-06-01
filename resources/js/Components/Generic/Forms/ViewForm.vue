<template>
    <div class="flex justify-center h-full w-full">
        <div class="max-w-fit sm:p-5 p-1 rounded-sm">
            <div class="flex items-center justify-end mb-3 gap-2">
                <Link :href="props.link" class="text-gray-600 hover:text-gray-900 duration-300">
                    <CloseIcon class="w-6 h-auto hover:rotate-90 duration-300" />
                </Link>
            </div>
            <div id="official-receipt-printable" class="shadow-xl px-5 py-8 mx-auto">
                <slot />
            </div>
            <div class="flex justify-end mt-3">
                <button @click="printForm" class="flex items-center gap-1 py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-90 hover:bg-vsu-olive">
                    <PrintIcon class="w-5 h-auto text-white" />
                    Print
                </button>
            </div>
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
                                margin: 1.6cm;
                            }
                        }

                        .printTable td {
                            padding: 0.5rem;
                            border: 1px solid;
                            font-size: 0.8rem;
                        }

                        .printTable .header-text, .printTable .form-title {
                            font-family: "Montserrat Bold",serif;
                        }

                        .printTable thead{
                            border: 1px solid rgb(6, 67, 13);
                            background-color: rgb(6, 67, 13);
                        }

                        .printTable .vsu-logo{
                            width: 15rem;
                            height: auto;
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
