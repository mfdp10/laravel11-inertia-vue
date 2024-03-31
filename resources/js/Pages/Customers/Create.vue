<script>
export default { name: "CustomersCreate" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from "@inertiajs/vue3"
import CustomerForm from "@/Components/Customers/Form.vue"

const props = defineProps({
    customer: {
        type: Object,
        required: true
    },
    is_active_ops: {
        type: Object,
        required: true
    }
})

const form = useForm({
    first_name: "",
    last_name: "",
    company: "",
    phone: "",
    mobile: "",
    id_card: "",
    email: "",
    comments: "",
    is_active: "yes",
    fileName: "",
    filePreview: "",
    is_active_ops: props.is_active_ops,
});


</script>

<template>
    <AppLayout title="Create customer">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __("create") + " " +
                __("customer").toLowerCase() }}</h1>
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
                <CustomerForm :form="form" @submit="form.post(route('customers.store'))" />
            </div>

        </div>
    </AppLayout>
</template>