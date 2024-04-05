<script>
export default { name: "TaskCategoriesForm" }
</script>

<script setup>

import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputFile from '@/Components/InputFile.vue';


const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    updating: {
        type: Boolean,
        required: false,
        default: false
    }
})

defineEmits(["submit"])

const captureFile = function ($event) {
    props.form.filePreview = $event.previewBase64;
    props.form.fileName = $event.file;
}

const onChange = function ($event) {
    props.form.is_active = $event.target.value;
}

defineExpose({
    captureFile,
})

const deleteImage = function ($event) {
    if (confirm("Are you sure to delete?")) {
        props.form.filePreview = "";//router.delete(route("task-categories.destroy", id))
    }
}

</script>
<template>
    <FormSection @submitted="$emit('submit')">

        <template #title>
            {{ updating ? __('Edit') + " " + __('task_category').toLowerCase() : __('Create') + " " +
        __('task_category').toLowerCase() + "" }}
        </template>
        <template #description>
            {{ updating ? __('txt_edit_task_category') : __('txt_new_task_category') }}
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-6 mb-5">
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <img class="rounded" width="50%" v-if="form.filePreview" :src="form.filePreview" alt="fileName">
                        <img class="rounded" width="50%" v-else="form.filePreview"
                            src="https://lh3.googleusercontent.com/d/1HIRzQeKdRoKE7FaWR_D_uUjVuy1pSBuo=s220" alt="">
                    </div>
                    <div>
                        <InputFile @file-updated="captureFile($event)" />
                        <br>
                        <br>
                        <PrimaryButton @click.prevent="deleteImage($event)" v-show="form.filePreview"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            {{ __("delete") }}</PrimaryButton>

                    </div>
                </div>
                <InputLabel for="name" name="Name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('task_category_name_label') }}</InputLabel>
                <TextInput id="name" v-model="form.name" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.name" class="mt-2" />
                <InputLabel for="is_active" name="Is view"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __("select_an_option") }}</InputLabel>
                <select name="is_active" v-model="form.is_active" @change="onChange($event)"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                    <option value="">{{ __("select_an_option") }}</option>
                    <option v-for="key in form.is_active_ops" :key="key" :value="key">{{ __(key) }}
                    </option>
                </select>
                <InputError :message="$page.props.errors.is_active" class="mt-2" />
            </div>
        </template>
        <template #actions>
            <PrimaryButton
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{ updating ? __("update") : __("create") }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>