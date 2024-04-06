<script>
export default { name: "ProductsForm" }
</script>

<script setup>

import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputFile from '@/Components/InputFile.vue';
import TextArea from '@/Components/TextArea.vue';

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
        props.form.filePreview = "";//router.delete(route("product-categories.destroy", id))
    }
}

</script>
<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? __('Edit') + " " + __('product').toLowerCase() : __('Create') + " " +
        __('product').toLowerCase() + "" }}
        </template>
        <template #description>
            {{ updating ? __('txt_edit_product') : __('txt_new_product') }}
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
                    {{ __('product_name_label') }}</InputLabel>
                <TextInput id="name" v-model="form.name" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.name" class="mt-2" />
                <InputLabel for="description" name="Description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('product_description_label') }}</InputLabel>
                <TextArea id="description" v-model="form.description" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.description" class="mt-2" />
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="weight" name="Weight"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('product_weight_label') }}</InputLabel>
                        <TextInput id="weight" v-model="form.weight" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.weight" class="mt-2" />
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="dimensions" name="Dimensions"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('product_dimensions_label') }}</InputLabel>
                        <TextInput id="dimensions" v-model="form.dimensions" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.dimensions" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-6 sm:grid-cols-6 gap-4">
                    <div class="col-span-6 md:col-span-2">
                        <InputLabel for="price" name="Price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('product_price_label') }}</InputLabel>
                        <TextInput id="price" v-model="form.price" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.price" class="mt-2" />
                    </div>
                    <div class="col-span-6 md:col-span-4">
                        <InputLabel for="is_active" name="Is active"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __("product_is_active") }}</InputLabel>
                        <select name="is_active" v-model="form.is_active" @change="onChange($event)"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                            <option value="">{{ __("select_an_option") }}</option>
                            <option v-for="key in form.is_active_ops" :key="key" :value="key">{{ __(key) }}
                            </option>
                        </select>
                        <InputError :message="$page.props.errors.is_active" class="mt-2" />
                    </div>
                </div>
                <InputLabel for="summary" name="Summary "
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('product_summary_label') }}</InputLabel>
                <TextArea id="summary" v-model="form.summary" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.summary" class="mt-2" />

                <InputLabel for="product_categories" name="Product categories "
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('product_categories') }}</InputLabel>

                <div class="d-inline-block mt-2" v-for="cat in form.product_categories_ops">
                    <label
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <input v-model="form.product_categories" type="checkbox" id="cat.id" :value="cat.id" />
                        <span class="ml-2"> {{ cat.name }} </span>
                    </label>
                </div>
            </div>

        </template>
        <template #actions>
            <PrimaryButton
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                {{ updating ? "Update" : "Create" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>