<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, Disclosure, DisclosureButton, DisclosurePanel, Popover, PopoverButton, PopoverGroup, PopoverPanel, } from '@headlessui/vue'
import { ArrowPathIcon, Bars3Icon, ChartPieIcon, CursorArrowRaysIcon, FingerPrintIcon, SquaresPlusIcon, XMarkIcon, } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon } from '@heroicons/vue/20/solid'
import ApplicationLogo from './ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3';

const products = [
    { name: 'Analytics', description: 'Get a better understanding of your traffic', href: '#', icon: ChartPieIcon },
    { name: 'Engagement', description: 'Speak directly to your customers', href: '#', icon: CursorArrowRaysIcon },
    { name: 'Security', description: 'Your customers’ data will be safe and secure', href: '#', icon: FingerPrintIcon },
    { name: 'Integrations', description: 'Connect with third-party tools', href: '#', icon: SquaresPlusIcon },
    { name: 'Automations', description: 'Build strategic funnels that will convert', href: '#', icon: ArrowPathIcon },
]
const callsToAction = [
    { name: 'Watch demo', href: '#', icon: PlayCircleIcon },
    { name: 'Contact sales', href: '#', icon: PhoneIcon },
]

const mobileMenuOpen = ref(false)
</script>
<script>
export default{
    computed: {
        isHomePage() {
            return window.location.pathname === '/';
        },
        isLoginPage() {
            return window.location.pathname === '/login';
        },
        isRegisterPage() {
            return window.location.pathname === '/register';
        },
    }
}
</script>
<style>
.cosine-bg {
    z-index: -1;
    @apply w-full;
    @apply fixed;
    @apply top-0;
    @apply shadow-md;
}

.cosine-green {
    clip-path: polygon(100% 0%, 0% 0% , 0% 65%, 1% 64.95%, 2% 64.8%, 3% 64.6%, 4% 64.3%, 5% 63.9%, 6% 63.45%, 7% 62.9%, 8% 62.25%, 9% 61.55%, 10% 60.8%, 11% 59.95%, 12% 59.05%, 13% 58.1%, 14% 57.1%, 15% 56.05%, 16% 55%, 17% 53.9%, 18% 52.8%, 19% 51.65%, 20% 50.5%, 21% 49.35%, 22% 48.2%, 23% 47.05%, 24% 45.9%, 25% 44.8%, 26% 43.75%, 27% 42.75%, 28% 41.75%, 29% 40.8%, 30% 39.9%, 31% 39.1%, 32% 38.35%, 33% 37.65%, 34% 37.05%, 35% 36.5%, 36% 36.05%, 37% 35.65%, 38% 35.35%, 39% 35.15%, 40% 35.05%, 41% 35%, 42% 35.05%, 43% 35.2%, 44% 35.45%, 45% 35.75%, 46% 36.15%, 47% 36.65%, 48% 37.2%, 49% 37.85%, 50% 38.55%, 51% 39.35%, 52% 40.2%, 53% 41.1%, 54% 42.05%, 55% 43.05%, 56% 44.1%, 57% 45.15%, 58% 46.3%, 59% 47.4%, 60% 48.55%, 61% 49.7%, 62% 50.85%, 63% 52%, 64% 53.15%, 65% 54.25%, 66% 55.35%, 67% 56.4%, 68% 57.45%, 69% 58.4%, 70% 59.35%, 71% 60.2%, 72% 61.05%, 73% 61.8%, 74% 62.45%, 75% 63.05%, 76% 63.6%, 77% 64.05%, 78% 64.4%, 79% 64.7%, 80% 64.85%, 81% 65%, 82% 65%, 83% 64.9%, 84% 64.75%, 85% 64.5%, 86% 64.2%, 87% 63.75%, 88% 63.25%, 89% 62.7%, 90% 62.05%, 91% 61.3%, 92% 60.5%, 93% 59.65%, 94% 58.75%, 95% 57.8%, 96% 56.8%, 97% 55.75%, 98% 54.65%, 99% 53.55%, 100% 52.4%);
}

.cosine-olive {
    clip-path: polygon(100% 0%, 0% 0% , 0% 65%, 1% 64.95%, 2% 64.8%, 3% 64.6%, 4% 64.3%, 5% 63.9%, 6% 63.45%, 7% 62.9%, 8% 62.25%, 9% 61.55%, 10% 60.8%, 11% 59.95%, 12% 59.05%, 13% 58.1%, 14% 57.1%, 15% 56.05%, 16% 55%, 17% 53.9%, 18% 52.8%, 19% 51.65%, 20% 50.5%, 21% 49.35%, 22% 48.2%, 23% 47.05%, 24% 45.9%, 25% 44.8%, 26% 43.75%, 27% 42.75%, 28% 41.75%, 29% 40.8%, 30% 39.9%, 31% 39.1%, 32% 38.35%, 33% 37.65%, 34% 37.05%, 35% 36.5%, 36% 36.05%, 37% 35.65%, 38% 35.35%, 39% 35.15%, 40% 35.05%, 41% 35%, 42% 35.05%, 43% 35.2%, 44% 35.45%, 45% 35.75%, 46% 36.15%, 47% 36.65%, 48% 37.2%, 49% 37.85%, 50% 38.55%, 51% 39.35%, 52% 40.2%, 53% 41.1%, 54% 42.05%, 55% 43.05%, 56% 44.1%, 57% 45.15%, 58% 46.3%, 59% 47.4%, 60% 48.55%, 61% 49.7%, 62% 50.85%, 63% 52%, 64% 53.15%, 65% 54.25%, 66% 55.35%, 67% 56.4%, 68% 57.45%, 69% 58.4%, 70% 59.35%, 71% 60.2%, 72% 61.05%, 73% 61.8%, 74% 62.45%, 75% 63.05%, 76% 63.6%, 77% 64.05%, 78% 64.4%, 79% 64.7%, 80% 64.85%, 81% 65%, 82% 65%, 83% 64.9%, 84% 64.75%, 85% 64.5%, 86% 64.2%, 87% 63.75%, 88% 63.25%, 89% 62.7%, 90% 62.05%, 91% 61.3%, 92% 60.5%, 93% 59.65%, 94% 58.75%, 95% 57.8%, 96% 56.8%, 97% 55.75%, 98% 54.65%, 99% 53.55%, 100% 52.4%);
}

.cosine-yellow {
    clip-path: polygon(100% 0%, 0% 0% , 0% 65%, 1% 64.95%, 2% 64.8%, 3% 64.6%, 4% 64.3%, 5% 63.9%, 6% 63.45%, 7% 62.9%, 8% 62.25%, 9% 61.55%, 10% 60.8%, 11% 59.95%, 12% 59.05%, 13% 58.1%, 14% 57.1%, 15% 56.05%, 16% 55%, 17% 53.9%, 18% 52.8%, 19% 51.65%, 20% 50.5%, 21% 49.35%, 22% 48.2%, 23% 47.05%, 24% 45.9%, 25% 44.8%, 26% 43.75%, 27% 42.75%, 28% 41.75%, 29% 40.8%, 30% 39.9%, 31% 39.1%, 32% 38.35%, 33% 37.65%, 34% 37.05%, 35% 36.5%, 36% 36.05%, 37% 35.65%, 38% 35.35%, 39% 35.15%, 40% 35.05%, 41% 35%, 42% 35.05%, 43% 35.2%, 44% 35.45%, 45% 35.75%, 46% 36.15%, 47% 36.65%, 48% 37.2%, 49% 37.85%, 50% 38.55%, 51% 39.35%, 52% 40.2%, 53% 41.1%, 54% 42.05%, 55% 43.05%, 56% 44.1%, 57% 45.15%, 58% 46.3%, 59% 47.4%, 60% 48.55%, 61% 49.7%, 62% 50.85%, 63% 52%, 64% 53.15%, 65% 54.25%, 66% 55.35%, 67% 56.4%, 68% 57.45%, 69% 58.4%, 70% 59.35%, 71% 60.2%, 72% 61.05%, 73% 61.8%, 74% 62.45%, 75% 63.05%, 76% 63.6%, 77% 64.05%, 78% 64.4%, 79% 64.7%, 80% 64.85%, 81% 65%, 82% 65%, 83% 64.9%, 84% 64.75%, 85% 64.5%, 86% 64.2%, 87% 63.75%, 88% 63.25%, 89% 62.7%, 90% 62.05%, 91% 61.3%, 92% 60.5%, 93% 59.65%, 94% 58.75%, 95% 57.8%, 96% 56.8%, 97% 55.75%, 98% 54.65%, 99% 53.55%, 100% 52.4%);
}
</style>

<template>
    <header>
        <nav class="text-white" aria-label="Global">
           <!-- <div class="cosine-yellow min-w-full bg-vsu-yellow md:pb-7 pb-2">-->
<!--                <div class="cosine-olive bg-vsu-olive md:pb-7 pb-2"> -->
<!--                    <div class="cosine-green bg-vsu-green flex md:flex-col md:pb-64 py-1 items-center justify-between text-white">-->
            <div class="min-w-full bg-vsu-yellow md:pb-3 pb-1 shadow-md">
                <div class="bg-vsu-olive md:pb-3 pb -1 shadow-md">
                    <div class="bg-vsu-green flex md:flex-col md:py-1 items-center justify-between text-white shadow-md">
                        <div class="flex md:hidden">
                            <button type="button" class="m-2.5 inline-flex items-center justify-center rounded-md p-2.5" @click="mobileMenuOpen = true">
                                <span class="sr-only">Open main menu</span>
                                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                        <PopoverGroup class="hidden lg:flex lg:gap-x-12">
                            <Popover class="relative">
                                <PopoverButton class="flex items-center gap-x-1 text-xs leading-6 focus:border-none">
                                    SERVICES
                                    <ChevronDownIcon class="h-5 w-5 flex-none" aria-hidden="true" />
                                </PopoverButton>
                                <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                                    <PopoverPanel class="absolute -left-8 top-full z-99 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                                        <div class="p-4">
                                            <div v-for="item in products" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                                <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                    <component :is="item.icon" class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                                </div>
                                                <div class="flex-auto">
                                                    <a :href="item.href" class="block font-semibold text-gray-900">
                                                        {{ item.name }}
                                                        <span class="absolute inset-0" />
                                                    </a>
                                                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                            <a v-for="item in callsToAction" :key="item.name" :href="item.href" class="flex items-center justify-center gap-x-2.5 p-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-100">
                                                <component :is="item.icon" class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                                                {{ item.name }}
                                            </a>
                                        </div>
                                    </PopoverPanel>
                                </transition>
                            </Popover>
                            <a href="#" class="text-xs leading-6">EVENTS</a>
                            <a href="#" class="text-xs leading-6">ABOUT</a>
                            <Link :href="'/'" class="text-xs" :class="{ 'text-vsu-yellow': isHomePage }">
                                HOME
                            </Link>
                            <Link :href="route('login')" class="text-xs" :class="{ 'text-vsu-yellow': isLoginPage }">
                                LOGIN
                            </Link>
                            <Link :href="route('register')" class="text-xs" :class="{ 'text-vsu-yellow': isRegisterPage }">
                                REGISTER
                            </Link>
                        </PopoverGroup>
                        <div class="text-white w-full md:text-3xl text-sm flex md:flex-col flex-row justify-between gap-4 text-center items-center">
                            <div class="md:hidden flex gap-4">
                                <Link :href="'/'" class="text-xs leading-6" :class="{ 'text-vsu-yellow': isHomePage }">
                                    HOME
                                </Link>
                                <Link :href="route('login')" class="text-xs leading-6" :class="{ 'text-vsu-yellow': isLoginPage }">
                                    LOGIN
                                </Link>
                                <Link :href="route('register')" class="text-xs leading-6" :class="{ 'text-vsu-yellow': isRegisterPage }">
                                    REGISTER
                                </Link>
                            </div>
                            <div class="md:block hidden font-montserrat font-semibold">
                                ELECTRONIC HEALTH RECORDS SYSTEM
                                <Link :href="'/'">
                                <span class="sr-only">EHR</span>
                                <ApplicationLogo class="h-auto md:w-20 w-10 mx-auto" />
                            </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-10" />
            <DialogPanel class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5 text-color-gray">
                        <span class="sr-only">ELECTRONIC HEALTH RECORDS SYSTEM</span>
                        <ApplicationLogo class="h-auto md:w-20 w-14" />
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <!-- <Disclosure as="div" class="-mx-3" v-slot="{ open }">
                                <DisclosureButton class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 hover:bg-gray-50">
                                    Product
                                    <ChevronDownIcon :class="[open ? 'rotate-180' : '', 'h-5 w-5 flex-none']" aria-hidden="true" />
                                </DisclosureButton>
                                <DisclosurePanel class="mt-2 space-y-2">
                                    <DisclosureButton v-for="item in [...products, ...callsToAction]" :key="item.name" as="a" :href="item.href" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ item.name }}</DisclosureButton>
                                </DisclosurePanel>
                            </Disclosure> -->
                            <a href="/" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                            <!-- <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
                            <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a> -->
                        </div>
                        <div class="py-6" v-if="!$page.props.auth.user">
                            <Link :href="route('login')" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                Login
                            </Link>
                            <Link :href="route('register')" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                Register
                            </Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
</template>
