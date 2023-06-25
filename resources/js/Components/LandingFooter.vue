<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<style>
.footer * {
    box-sizing: border-box;
}
.footer {
    padding: 70px 0 0;
    box-sizing: border-box;
    width: 100%;
    font-size: 1em;
}
.footer .cont {
    max-width: 1170px;
    margin: auto;
}
.footer .row {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}
.footer .row > div:nth-child(1) {
    width: 35%;
}
.footer .row > div {
    width: 20%;
    padding: 0 25px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    flex-grow: 1;
}

.footer .row p {
    margin: 20px 0;
    font-size: 0.9em;
    line-height: 1.8em;
}

.footer .row h4 {
    @apply bg-vsu-green;
    @apply text-white;
    width: fit-content;
    border-radius: 7px;
    padding: 5px 10px;
    font-weight: 600;
}

.footer .row ul,
.footer .row li {
    list-style-type: none;
    padding-left: 0;
    margin: 15px 0;
    transition: 0.3s;
    overflow: hidden;
}

.footer .row li {
    transform: translateX(-15px);
}
.footer .row li::before {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-top: 5px solid transparent;
    @apply border-l-8;
    @apply border-l-vsu-yellow;
    border-bottom: 5px solid transparent;
}
.footer .row li:hover {
    transform: translateX(0);
}
.footer .row ul a {
    text-decoration: none;
    margin-left: 15px;
}

.footer .row .socialButton {
    display: flex;
    align-items: center;
    gap: 25px;
    cursor: pointer;
    width: fit-content;
    margin-top: 30px;
}
.footer .row .socialButton i {
    font-size: 1.9em;
    text-decoration: none;
    transition: 0.3s;
    opacity: 0.5;
    transform: translateY(0);
}
.footer .row .socialButton i:hover {
    opacity: 1;
    transform: translateY(-4px);
}

.footer .copyright {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 40px;
    height: 80px;
    font-size: 0.8em;
}

/* Responsive */
@media only screen and (max-width: 1170px) {
    .footer .row > div {
        width: 50% !important;
        margin-bottom: 30px;
    }
}
@media only screen and (max-width: 574px) {
    .footer .row > div {
        width: 100% !important;
    }
}
</style>

<template>
    <footer class="footer bg-white text-gray-900">
        <div class="cont">
            <div class="row">
                <div>
                    <h2 class="font-semibold text-md">Electronic Health Records System</h2>
                    <p class="text-justify font-roboto">
                        Introducing our state-of-the-art Electronic Health Record (EHR) system, designed to streamline and improve the way healthcare providers manage patient information. Our EHR system is an advanced software application that allows doctors and medical staff to quickly and easily access patient data, view medical history, and manage health records all in one place. The system is designed with cutting-edge security measures to ensure patient confidentiality, and it is customizable to meet the unique needs of any healthcare organization. Our EHR system is a powerful tool that simplifies clinical workflows and helps healthcare providers provide better care to their patients.
                    </p>
                </div>
<!--                <div>-->
<!--                    <h4>Pages</h4>-->
<!--                    <ul>-->
<!--                        <li><a href="#">About Us</a></li>-->
<!--                        <li><a href="#">Our Services</a></li>-->
<!--                        <li><a href="#">Events</a></li>-->
<!--                        <template v-if="!$page.props.auth.user">-->
<!--                        <li>-->
<!--                            <Link :href="route('login')">-->
<!--                                Login-->
<!--                            </Link>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <Link :href="route('register')">-->
<!--                                Register-->
<!--                            </Link>-->
<!--                        </li>-->
<!--                        </template>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <h4>Help</h4>-->
<!--                    <ul>-->
<!--                        <li><a href="#">FAQ</a></li>-->
<!--                        <li><a href="#">Payments Options</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </div>
        <div class="text-center text-white p-5 bg-vsu-green">
            <p>Copyright © 2023 All Right Reserved</p>
        </div>
    </footer>
</template>
