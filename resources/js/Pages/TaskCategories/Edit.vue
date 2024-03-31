<script>
export default { name: "TaskCategoriesEdit" }
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from "@inertiajs/vue3"
import TaskCategoryForm from "@/Components/TaskCategories/Form.vue"

const props = defineProps({
    task_category: {
        type: Object,
        required: true
    },
    is_active_ops: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: props.task_category.name,
    is_active: props.task_category.is_active,
    fileName: "",
    filePreview: props.task_category.image ? "/storage/" + props.task_category.image.url : "",
    prev_image: props.task_category.image ? "/storage/" + props.task_category.image.url : "",
    is_active_ops: props.is_active_ops,
    _method:"put",
})

</script>

<template>
    <AppLayout title="Edit category">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-300">{{ __("edit") + " " +
                __("task_category").toLowerCase() }}</h1>
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <Link :href="route('task-categories.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{__("go_to_list")}}</Link>
            </div>

            <div class="p-4 text-sm mb-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <TaskCategoryForm :form="form" :updating="true"
                    @submit="form.post(route('task-categories.update', task_category.id))" />
            </div>

        </div>
    </AppLayout>
</template>