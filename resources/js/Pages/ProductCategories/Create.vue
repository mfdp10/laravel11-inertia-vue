<script>
export default { name: "ProductCategoriesCreate" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from "@inertiajs/vue3"
import ProductCategoryForm from "@/Components/ProductCategories/Form.vue"

const props = defineProps({
    product_category: {
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
    is_active: "yes",
    fileName: "",
    filePreview: "",
    is_active_ops: props.is_active_ops,
})

</script>

<template>
    <AppLayout title="Create category">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("create") + " " +
                __("product_category").toLowerCase() }} </h1>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <Link :href="route('product-categories.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("go_to_list") }}</Link>
            </div>

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <ProductCategoryForm :form="form" @submit="form.post(route('product-categories.store'))" />
            </div>

        </div>
    </AppLayout>
</template>