<template>
    <div class="flex flex-col justify-center h-full min-w-fit mx-auto">
        <div class="flex items-center justify-end mb-3 gap-2">
            <button @click="$router.go(-1)" class="text-gray-600 hover:text-gray-900 duration-300" title="Close">
                <CloseIcon class="w-7 h-auto hover:rotate-90 duration-300" />
            </button>
        </div>
        <div id="printableSection" class="printTable shadow-2xl text-sm px-10 py-10 mx-auto max-w-full">
            <slot />
        </div>
        <div class="fixed bottom-2 right-5">
            <button @click="print" class="flex items-center gap-1 py-1 px-4 bg-vsu-green text-white rounded-md duration-100 active:scale-90 hover:bg-vsu-olive">
                <PrintIcon class="w-5 h-auto text-white" />
                Print
            </button>
<!--            <button @click="generatePDF">Generate PDF</button>-->
        </div>
    </div>
</template>
<style>
@media print {
    body * {
        visibility: hidden;
    }

    #printThis, #printThis * {
        visibility: visible;
    }

    #printThis {
        position: absolute;
        left: 0;
        top: 0;
        padding: 2rem;
        box-shadow: none;
        width: 100%;
        max-height: 70rem;
        overflow: hidden;
    }

    #printThis input{
        box-shadow: none;
    }
}
</style>
<script setup>
import {Link} from "@inertiajs/vue3";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import PrintIcon from "@/Components/Icons/PrintIcon.vue";
import jsPDF from 'jspdf';
const props = defineProps({
    link: {
        type: String,
        default: ''
    },
});

const generatePDF = () => {
    const doc = new jsPDF();

    // Add content to the PDF
    doc.html(document.querySelector("#printableSection"), {
        callback: function (pdf) {
            pdf.save("sample.pdf");
        },
        x: 100,
        y: 100,
    });

    // Save the PDF
    doc.save('sample.pdf');
}

const print = () => {
    const sectionID = "printableSection";
    // get the ID of the section to be printed
    let section = document.getElementById(sectionID)
    // set the ID of the section to match CSS @media print rules
    section.setAttribute("id", "printThis")
    //set print quality to high
    section.setAttribute("style", "width: 100%; max-height: 70rem; overflow: hidden;")
    // print the section
    window.print();
    // set back the ID of the section to what it was...
    section.setAttribute("id", sectionID)
}

const printForm = () => {
    const printableContent = document.getElementById('printableSection');
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
