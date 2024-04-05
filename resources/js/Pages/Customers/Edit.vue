<script>
export default { name: "CustomersEdit" }
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

    first_name: props.customer.first_name,
    last_name: props.customer.last_name,
    company: props.customer.company,
    phone: props.customer.phone,
    mobile: props.customer.mobile,
    id_card: props.customer.id_card,
    email: props.customer.email,
    comments: props.customer.comments,
    image_name: props.customer.image_name,
    is_active: props.customer.is_active,
    fileName: "",
    filePreview: props.customer.image ? props.customer.image.url : "",
    prev_image: props.customer.image ? props.customer.image.url : "",
    is_active_ops: props.is_active_ops,
    _method: "put",
})


</script>

<template>
    <AppLayout title="Edit customer">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ __("edit") + " " +
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
                <CustomerForm :form="form" :updating="true"
                    @submit="form.post(route('customers.update', customer.id))" />
            </div>

        </div>
    </AppLayout>
</template>