<script>
export default { name: "ProductsEdit" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from "@inertiajs/vue3"
import ProductsForm from "@/Components/Products/Form.vue"

const props = defineProps({
    product: {
        type: Object,
        required: true
    },
    product_categories_ops: {
        type: Object,
        required: true
    },
    saved_product_categories: {
        type: Object,
        required: true
    },
    is_active_ops: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: props.product.name,
    description: props.product.description,
    summary: props.product.summary,
    weight: props.product.weight,
    dimensions: props.product.dimensions,
    price: props.product.price,
    image_name: props.product.pictures.length > 0 ? props.product.pictures[0].image_name : "",
    is_active: props.product.is_active,
    product_categories: props.saved_product_categories,
    fileName: "",
    filePreview: (props.product.pictures.length) > 0 ? props.product.pictures[0].url : "",
    prev_image: (props.product.pictures.length) > 0 ? props.product.pictures[0].url : "",
    is_active_ops: props.is_active_ops,
    product_categories_ops: props.product_categories_ops,
    _method: "put",
})

</script>

<template>
    <AppLayout title="Edit product">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("edit") + " " +
                __("product").toLowerCase() }}</h1>
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
                <ProductsForm :form="form" :updating="true" @submit="form.post(route('products.update', product.id))" />
            </div>

        </div>
    </AppLayout>
</template>