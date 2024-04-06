<script>
export default { name: "ProductsIndex" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from "@inertiajs/vue3"

defineProps({
    products: {
        type: Object,
        required: true
    }
})

const deleteProduct = (id) => {
    if (confirm("Are you sure to delete?")) {
        router.delete(route("products.destroy", id))
    }
}
</script>

<template>
    <AppLayout title="Products">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("products")
                }}
            </h1>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert" v-if="$page.props.user.permissions.includes('products.create')">
                <Link :href="route('products.create')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("Create") }} {{ __("product").toLowerCase() }}
                </Link>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="hidden sm:table-cell px-6 py-3">
                                {{ __("image_th") }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __("product_name_th") }}
                            </th>
                            <th scope="col" class="hidden md:table-cell px-6 py-3">
                                {{ __("product_price_th") }}
                            </th>
                            <th scope="col" class="hidden sm:table-cell px-6 py-3">
                                {{ __("product_is_active") }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __("Edit") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="hidden sm:table-cell px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img v-if="product.pictures.length > 0" class="rounded" width="60"
                                    :src="product.pictures[0].url" alt="">
                                <img class="rounded" width="60"
                                    src="https://lh3.googleusercontent.com/d/1HIRzQeKdRoKE7FaWR_D_uUjVuy1pSBuo=s220"
                                    alt="" v-else="product.pictures.lenght > 0">
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ product.name }}
                            </th>
                            <th scope="row"
                                class="hidden sm:table-cell px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ product.price }}
                            </th>
                            <th scope="row"
                                class="hidden md:table-cell px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ __(product.is_active) }}
                            </th>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex">
                                    <Link :href="route('products.show', product.id)"
                                        v-if="$page.props.user.permissions.includes('products.index')"
                                        class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 sm:px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span class="sm:hidden block"><svg class="w-4 h-4 text-gray-800 dark:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7.556 8.5h8m-8 3.5H12m7.111-7H4.89a.896.896 0 0 0-.629.256.868.868 0 0 0-.26.619v9.25c0 .232.094.455.26.619A.896.896 0 0 0 4.89 16H9l3 4 3-4h4.111a.896.896 0 0 0 .629-.256.868.868 0 0 0 .26-.619v-9.25a.868.868 0 0 0-.26-.619.896.896 0 0 0-.63-.256Z" />
                                        </svg></span><span class="hidden sm:block">{{ __("details") }}</span>
                                    </Link>
                                    <span class="inline-flex">
                                        <Link :href="route('products.edit', product.id)"
                                            v-if="$page.props.user.permissions.includes('products.edit')"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 sm:px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <span class="sm:hidden block"><svg class="w-4 h-4 text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>

                                        </span><span class="hidden sm:block">{{ __("edit") }}</span>
                                        </Link>
                                    </span>
                                    <Link @click="deleteProduct(product.id)"
                                        v-if="$page.props.user.permissions.includes('products.destroy')"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 sm:px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    <span class="sm:hidden block"><svg class="w-4 h-4 text-gray-800 dark:text-white"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </span> <span class="hidden sm:block">{{ __("delete") }}</span></Link>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert" v-if="products.total > products.per_page">
                <Link v-if="products.current_page > 1" :href="products.prev_page_url"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("previous") }}</Link>
                <div v-else></div>

                <Link v-if="products.current_page < products.last_page" :href="products.next_page_url"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("next") }}</Link>
                <div v-else></div>
            </div>

        </div>
    </AppLayout>
</template>