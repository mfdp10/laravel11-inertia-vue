<script>
export default { name: "ProductsShow" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <AppLayout title="Product details">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("product") }} {{
                __("details").toLowerCase() }}</h1>
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
                <div class="flex flex-col sm:flex-row">
                    <img class="rounded w-60 h-60" :src="product.pictures[0].url" alt=""
                        v-if="product.pictures.length > 0">
                    <img class="rounded w-60 h-60"
                        src="https://lh3.googleusercontent.com/d/1HIRzQeKdRoKE7FaWR_D_uUjVuy1pSBuo=s220" alt=""
                        v-else="product.image">
                    <div class="flex flex-col ml-4 sm:mt-0 mt-4">
                        <p><b>{{ __("product_name_label") }}: </b>{{ product.name }}</p>
                        <p><b>{{ __("product_description_label") }}: </b>{{ product.description }}</p>
                        <p><b>{{ __("product_summary_label") }}: </b>{{ product.summary }}</p>
                        <p><b>{{ __("product_weight_label") }}: </b>{{ product.weight }}</p>
                        <p><b>{{ __("product_dimensions_label") }}: </b>{{ product.dimensions }}</p>
                        <p><b>{{ __("product_price_label") }}: </b>{{ product.price }}</p>
                        <p><b>{{ __("product_is_active_label") }}: </b>{{ __(product.is_active) }}</p>
                    </div>
                </div>
                <p><b>{{ __("categories") }}: </b></p>
                <div class="d-inline-block mt-2" v-for="cat in product.product_categories">

                    <label
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <span class="ml-2"> {{ cat.name }} </span>
                    </label>
                </div>

            </div>

        </div>
    </AppLayout>
</template>