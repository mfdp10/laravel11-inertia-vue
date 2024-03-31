<script>
export default { name: "TaskCategoriesIndex" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from "@inertiajs/vue3"

defineProps({
    task_categories: {
        type: Object,
        required: true
    },
    // is_active: {
    //     type: Object,
    //     required: true
    // }
})

const deleteTaskCategory = (id) => {
    if (confirm("Are you sure to delete?")) {
        router.delete(route("task-categories.destroy", id))
    }
}
</script>

<template>
    <AppLayout title="Task categories">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("task_categories") }}
            </h1>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert" v-if="$page.props.user.permissions.includes('task-categories.create')">
                <Link :href="route('task-categories.create')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("Create") }} {{ __("task_category").toLowerCase() }}
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
                                {{ __("task_category_name_th") }}
                            </th>
                            <th scope="col" class="hidden sm:table-cell px-6 py-3">
                                {{ __("task_is_active") }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __("Edit") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in task_categories.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="hidden sm:table-cell px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="rounded" width="60" :src="'/storage/' + category.image.url" alt="" v-if="category.image">
                                <img class="rounded" width="60" src="/storage/no-image.jpg" alt="" v-else="category.image">
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ category.name }}
                            </th>
                            <th scope="row"
                                class="hidden sm:table-cell px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ __(category.is_active) }}
                            </th>
                            <td class="px-6 py-4 text-right">

                                <span class="inline-flex">
                                    <Link :href="route('task-categories.edit', category.id)"
                                        v-if="$page.props.user.permissions.includes('task-categories.edit')"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    {{ __("edit") }}
                                    </Link>
                                
                                <Link @click="deleteTaskCategory(category.id)"
                                    v-if="$page.props.user.permissions.includes('task-categories.destroy')"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                {{ __("delete") }}</Link>
                            </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert" v-if="task_categories.total > task_categories.per_page">
                <Link v-if="task_categories.current_page > 1" :href="task_categories.prev_page_url"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("previous") }}</Link>
                <div v-else></div>

                <Link v-if="task_categories.current_page < task_categories.last_page"
                    :href="task_categories.next_page_url"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __("next") }}</Link>
                <div v-else></div>
            </div>

        </div>
    </AppLayout>
</template>