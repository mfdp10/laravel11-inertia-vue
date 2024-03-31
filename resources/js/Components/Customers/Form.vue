<script>
export default { name: "CustomesForm" }
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
            {{ updating ? __('Edit') + " " + __('customer').toLowerCase() : __('Create') + " " +
        __('customer').toLowerCase() + "" }}
        </template>
        <template #description>
            {{ updating ? __('txt_edit_customer') : __('txt_new_customer') }}
        </template>
        <template #form>

            <div class="col-span-6 sm:col-span-6 mb-5">
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <img class="rounded" width="50%" v-if="form.filePreview" :src="form.filePreview" alt="fileName">
                        <img class="rounded" width="50%" v-else="form.filePreview" src="/storage/no-image.jpg" alt="">
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
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="first_name" name="First name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_name_label') }}</InputLabel>
                        <TextInput id="first_name" v-model="form.first_name" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.first_name" class="mt-2" />
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="last_name" name="Last name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_last_label') }}</InputLabel>
                        <TextInput id="last_name" v-model="form.last_name" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.last_name" class="mt-2" />
                    </div>
                </div>
                <InputLabel for="company" name="Last name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('customer_company_label') }}</InputLabel>
                <TextInput id="company" v-model="form.company" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.company" class="mt-2" />
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="phone" name="Phone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_phone_label') }}</InputLabel>
                        <TextInput id="phone" v-model="form.phone" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.phone" class="mt-2" />
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <InputLabel for="mobile" name="Mobile"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_mobile_label') }}</InputLabel>
                        <TextInput id="mobile" v-model="form.mobile" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.mobile" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-6 sm:grid-cols-6 gap-4">
                    <div class="col-span-6 md:col-span-2">
                        <InputLabel for="id_card" name="ID Card"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_id_card_label') }}</InputLabel>
                        <TextInput id="id_card" v-model="form.id_card" type="text" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.id_card" class="mt-2" />
                    </div>
                    <div class="col-span-6 md:col-span-4">
                        <InputLabel for="email" name="Email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('customer_email_label') }}</InputLabel>
                        <TextInput id="email" v-model="form.email" type="email" autocomplite="none"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        <InputError :message="$page.props.errors.email" class="mt-2" />
                    </div>
                </div>
                <InputLabel for="comments" name="Comments"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('customer_comments_label') }}</InputLabel>
                <TextArea id="comments" v-model="form.comments" type="text" autocomplite="none"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <InputError :message="$page.props.errors.comments" class="mt-2" />
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
                {{ updating ? "Update" : "Create" }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>