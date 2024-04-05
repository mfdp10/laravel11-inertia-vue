<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import LanguageSelector from '@/Shared/LanguageSelector.vue';

defineProps({
    title: String
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    {{ __("Dashboard") }}
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('tasks.index')">
                                <NavLink :href="route('tasks.index')" :active="route().current('tasks.*')">
                                    {{ __("tasks") }}
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('products.index')">
                                <NavLink :href="route('products.index')" :active="route().current('products.*')">
                                    {{ __("products") }}
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('customers.index')">
                                <NavLink :href="route('customers.index')" :active="route().current('customers.*')">
                                    {{ __("customers") }}
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('roles.index')">
                                <NavLink :href="route('roles.index')" :active="route().current('roles.*')">
                                    {{ __("roles") }}
                                </NavLink>
                            </div>
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('task-categories.index')">
                                <NavLink :href="route('task-categories.index')"
                                    :active="route().current('task-categories.*')">
                                    {{ __("task_categories") }}
                                </NavLink>
                            </div> -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                v-if="$page.props.user.permissions.includes('roles.index')">
                                <!-- Aux Dropdown -->
                                <div class="hidden sm:flex sm:items-center">
                                    <div class="relative">
                                        <Dropdown>
                                            <template #trigger>
                                                <button v-if="$page.props.user.permissions.includes('reads roles')"
                                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        :src="$page.props.auth.user.profile_photo_url"
                                                        :alt="$page.props.auth.user.name">
                                                </button>

                                                <span v-else class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                        Aux

                                                        <svg class="ms-2 -me-0.5 h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Auxiliary models
                                                </div>

                                                <div class="border-t border-gray-200" />
                                                <DropdownLink
                                                    v-if="$page.props.user.permissions.includes('task-categories.index')"
                                                    :href="route('task-categories.index')"
                                                    :active="route().current('task-categories.*')">
                                                    {{ __("task_categories") }}
                                                </DropdownLink>

                                                <DropdownLink
                                                    v-if="$page.props.user.permissions.includes('product-categories.index')"
                                                    :href="route('product-categories.index')"
                                                    :active="route().current('product-categories.*')">
                                                    {{ __("product_categories") }}
                                                </DropdownLink>

                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>

                                <!-- End Aux Dropdown -->
                            </div>

                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="ms-3 relative">
                                <!-- Teams Dropdown -->
                                <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.current_team.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <DropdownLink
                                                :href="route('teams.show', $page.props.auth.user.current_team)">
                                                Team Settings
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                                :href="route('teams.create')">
                                                Create New Team
                                            </DropdownLink>

                                            <!-- Team Switcher -->
                                            <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.auth.user.all_teams"
                                                    :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <DropdownLink as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                    class="me-2 h-5 w-5 text-green-400"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>

                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                :src="$page.props.auth.user.profile_photo_url"
                                                :alt="$page.props.auth.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                            :href="route('api-tokens.index')">
                                            API Tokens
                                        </DropdownLink>

                                        <div class="border-t border-gray-200 dark:border-gray-600" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- flas countries Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>

                                        <span class="inline-flex rounded-md">
                                            <button type="button" v-if="$page.props.locale === 'en'"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                English

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                            <button type="button" v-else-if="$page.props.locale === 'es'"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                Español

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>

                                        <DropdownLink :href="$page.props.locale === 'en' ? route('lang', 'es') : ''">
                                            <div class="inline-flex items-center">
                                                <svg class="h-3.5 w-3.5 rounded-full me-2"
                                                    enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m0 256c0 31.314 5.633 61.31 15.923 89.043l240.077 22.261 240.077-22.261c10.29-27.733 15.923-57.729 15.923-89.043s-5.633-61.31-15.923-89.043l-240.077-22.261-240.077 22.261c-10.29 27.733-15.923 57.729-15.923 89.043z"
                                                        fill="#ffda44" />
                                                    <g fill="#d80027">
                                                        <path
                                                            d="m496.077 166.957c-36.171-97.484-130.006-166.957-240.077-166.957s-203.906 69.473-240.077 166.957z" />
                                                        <path
                                                            d="m15.923 345.043c36.171 97.484 130.006 166.957 240.077 166.957s203.906-69.473 240.077-166.957z" />
                                                    </g>
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                </svg> Español
                                            </div>
                                        </DropdownLink>

                                        <DropdownLink :href="$page.props.locale === 'es' ? route('lang', 'en') : ''">
                                            <div class="inline-flex items-center">
                                                <svg class="h-3.5 w-3.5 rounded-full me-2"
                                                    enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="256" cy="256" fill="#f0f0f0" r="256" />
                                                    <g fill="#0052b4">
                                                        <path
                                                            d="m52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178z" />
                                                        <path
                                                            d="m503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076z" />
                                                        <path
                                                            d="m8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075z" />
                                                        <path
                                                            d="m411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177z" />
                                                        <path
                                                            d="m100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102v-133.176z" />
                                                        <path
                                                            d="m189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075z" />
                                                        <path
                                                            d="m322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075z" />
                                                        <path
                                                            d="m370.005 322.784 89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076z" />
                                                    </g>
                                                    <g fill="#d80027">
                                                        <path
                                                            d="m509.833 222.609h-220.44-.001v-220.442c-10.931-1.423-22.075-2.167-33.392-2.167-11.319 0-22.461.744-33.391 2.167v220.44.001h-220.442c-1.423 10.931-2.167 22.075-2.167 33.392 0 11.319.744 22.461 2.167 33.391h220.44.001v220.442c10.931 1.423 22.073 2.167 33.392 2.167 11.317 0 22.461-.743 33.391-2.167v-220.44-.001h220.442c1.423-10.931 2.167-22.073 2.167-33.392 0-11.317-.744-22.461-2.167-33.391z" />
                                                        <path
                                                            d="m322.783 322.784 114.236 114.236c5.254-5.252 10.266-10.743 15.048-16.435l-97.802-97.802h-31.482z" />
                                                        <path
                                                            d="m189.217 322.784h-.002l-114.235 114.235c5.252 5.254 10.743 10.266 16.435 15.048l97.802-97.804z" />
                                                        <path
                                                            d="m189.217 189.219v-.002l-114.236-114.237c-5.254 5.252-10.266 10.743-15.048 16.435l97.803 97.803h31.481z" />
                                                        <path
                                                            d="m322.783 189.219 114.237-114.238c-5.252-5.254-10.743-10.266-16.435-15.047l-97.802 97.803z" />
                                                    </g>
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                    <g />
                                                </svg> English
                                            </div>
                                        </DropdownLink>

                                    </template>
                                </Dropdown>
                            </div>

                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                @click="showingNavigationDropdown = !showingNavigationDropdown">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('tasks.*')">
                            {{ __("tasks") }}
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('products.*')">
                            {{ __("products") }}
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('customers.index')" :active="route().current('customers.*')">
                            {{ __("customers") }}
                        </ResponsiveNavLink>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('roles.*')">
                            {{ __("roles") }}
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive aux -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Auxiliary models
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('task-categories.index')"
                                :active="route().current('task-categories.*')">
                                {{ __("task_categories") }}
                            </ResponsiveNavLink>

                            <ResponsiveNavLink :href="route('product-categories.index')"
                                :active="route().current('product-categories.*')">
                                {{ __("product_categories") }}
                            </ResponsiveNavLink>


                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)"
                                    :active="route().current('teams.show')">
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                    :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </ResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                    <div class="border-t border-gray-200 dark:border-gray-600" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Switch Teams
                                    </div>

                                    <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                        <form @submit.prevent="switchToTeam(team)">
                                            <ResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                        class="me-2 h-5 w-5 text-green-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </ResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>

                    <!-- flags languages -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

                        <ResponsiveNavLink :href="$page.props.locale === 'en' ? route('lang', 'es') : ''">
                            <div class="inline-flex items-center">
                                <svg class="h-3.5 w-3.5 rounded-full me-2" enable-background="new 0 0 512 512"
                                    viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m0 256c0 31.314 5.633 61.31 15.923 89.043l240.077 22.261 240.077-22.261c10.29-27.733 15.923-57.729 15.923-89.043s-5.633-61.31-15.923-89.043l-240.077-22.261-240.077 22.261c-10.29 27.733-15.923 57.729-15.923 89.043z"
                                        fill="#ffda44" />
                                    <g fill="#d80027">
                                        <path
                                            d="m496.077 166.957c-36.171-97.484-130.006-166.957-240.077-166.957s-203.906 69.473-240.077 166.957z" />
                                        <path
                                            d="m15.923 345.043c36.171 97.484 130.006 166.957 240.077 166.957s203.906-69.473 240.077-166.957z" />
                                    </g>
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                </svg> Español
                            </div>
                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="$page.props.locale === 'es' ? route('lang', 'en') : ''">
                            <div class="inline-flex items-center">
                                <svg class="h-3.5 w-3.5 rounded-full me-2" enable-background="new 0 0 512 512"
                                    viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="256" cy="256" fill="#f0f0f0" r="256" />
                                    <g fill="#0052b4">
                                        <path d="m52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178z" />
                                        <path
                                            d="m503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076z" />
                                        <path
                                            d="m8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075z" />
                                        <path d="m411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177z" />
                                        <path
                                            d="m100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102v-133.176z" />
                                        <path
                                            d="m189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075z" />
                                        <path
                                            d="m322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075z" />
                                        <path
                                            d="m370.005 322.784 89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076z" />
                                    </g>
                                    <g fill="#d80027">
                                        <path
                                            d="m509.833 222.609h-220.44-.001v-220.442c-10.931-1.423-22.075-2.167-33.392-2.167-11.319 0-22.461.744-33.391 2.167v220.44.001h-220.442c-1.423 10.931-2.167 22.075-2.167 33.392 0 11.319.744 22.461 2.167 33.391h220.44.001v220.442c10.931 1.423 22.073 2.167 33.392 2.167 11.317 0 22.461-.743 33.391-2.167v-220.44-.001h220.442c1.423-10.931 2.167-22.073 2.167-33.392 0-11.317-.744-22.461-2.167-33.391z" />
                                        <path
                                            d="m322.783 322.784 114.236 114.236c5.254-5.252 10.266-10.743 15.048-16.435l-97.802-97.802h-31.482z" />
                                        <path
                                            d="m189.217 322.784h-.002l-114.235 114.235c5.252 5.254 10.743 10.266 16.435 15.048l97.802-97.804z" />
                                        <path
                                            d="m189.217 189.219v-.002l-114.236-114.237c-5.254 5.252-10.266 10.743-15.048 16.435l97.803 97.803h31.481z" />
                                        <path
                                            d="m322.783 189.219 114.237-114.238c-5.252-5.254-10.743-10.266-16.435-15.047l-97.802 97.803z" />
                                    </g>
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                    <g />
                                </svg> English
                            </div>
                        </ResponsiveNavLink>

                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </ResponsiveNavLink>

                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures"
                                :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)"
                                    :active="route().current('teams.show')">
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                    :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </ResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                    <div class="border-t border-gray-200 dark:border-gray-600" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Switch Teams
                                    </div>

                                    <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                        <form @submit.prevent="switchToTeam(team)">
                                            <ResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                        class="me-2 h-5 w-5 text-green-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </ResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
