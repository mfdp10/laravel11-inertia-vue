<template>
    <div class="ml-4">
        <Link :href="route('language', [selectable_locale])">
        <Icon class="w-5 h-5" :name="selectable_locale" />
        </Link>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon.vue'
import { Link } from '@inertiajs/vue3'

export default {
    name: "LanguageSelector",
    components: {
        Icon, Link
    },

    computed: {
        selectable_locale() {
            if (this.$page.props.locale == 'en') {
                return 'es';
            }
            return 'en'
        }
    },
}
</script>

<style scoped></style>