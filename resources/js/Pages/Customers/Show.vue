<script>
export default { name: "CustomersShow" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    customer: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <AppLayout title="Customer details">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("customer") }} {{
                __("details").toLowerCase() }}</h1>
        </template>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <Link :href="route('customers.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("go_to_list") }}</Link>
            </div>

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <div class="flex flex-col sm:flex-row">
                    <img class="rounded w-60 h-60" :src="'/storage/' + customer.image.url" alt="" v-if="customer.image">
                    <img class="rounded w-60 h-60"
                        src="https://lh3.googleusercontent.com/d/1HIRzQeKdRoKE7FaWR_D_uUjVuy1pSBuo=s220" alt=""
                        v-else="customer.image">
                    <div class="flex flex-col ml-4 sm:mt-0 mt-4">
                        <p><b>{{ __("customer_name_label") }}: </b>{{ customer.first_name }}</p>
                        <p><b>{{ __("customer_last_label") }}: </b>{{ customer.last_name }}</p>
                        <p><b>{{ __("customer_company_label") }}: </b>{{ customer.company }}</p>
                        <p><b>{{ __("customer_phone_label") }}: </b>{{ customer.phone }}</p>
                        <p><b>{{ __("customer_mobile_label") }}: </b>{{ customer.mobile }}</p>
                        <p><b>{{ __("customer_id_card_label") }}: </b>{{ customer.id_card }}</p>
                        <p><b>{{ __("customer_email_label") }}: </b>{{ customer.email }}</p>
                        <p><b>{{ __("customer_is_active_label") }}: </b>{{ __(customer.is_active) }}</p>
                        <p><b>{{ __("customer_comments_label") }}: </b>{{ customer.comments }}</p>
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>