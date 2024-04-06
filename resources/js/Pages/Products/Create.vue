<script>
export default { name: "ProductCreate" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from "@inertiajs/vue3"
import ProductsForm from "@/Components/Products/Form.vue"

const props = defineProps({
    product_categories_ops: {
        type: Object,
        required: true
    },
    is_active_ops: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: "",
    description: "",
    summary: "",
    weight: "",
    dimensions: "",
    price: "",
    image_name: "",
    is_active: "yes",
    product_categories: [],
    fileName: "",
    filePreview: "",
    is_active_ops: props.is_active_ops,
    product_categories_ops: props.product_categories_ops
})

</script>

<template>
    <AppLayout title="Create product">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("create") + " " +
                __("product").toLowerCase() }} </h1>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <Link :href="route('products.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("go_to_list") }}</Link>
            </div>

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <ProductsForm :form="form" @submit="form.post(route('products.store'))" />
            </div>

        </div>
    </AppLayout>
</template>