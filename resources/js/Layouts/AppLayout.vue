<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Search from '../Pages/Components/Search.vue';
import Compose from '../Pages/Components/Compose.vue';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <JetBanner />

        <div class="min-h-screen bg-white dark:bg-gray-900">
            <div v-if="$page.props.auth.user === null"
                class="sticky top-0 z-50 navbar bg-gray-100 dark:bg-gray-900 shadow-sm">
                <div class="navbar-start ">
                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="#a7081a">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <IntertiaLink href="/">Home</IntertiaLink>
                            </li>
                            <li>
                                <IntertiaLink href="/login">Login</IntertiaLink>
                            </li>
                            <li>
                                <IntertiaLink href="/register">Register</IntertiaLink>
                            </li>
                        </ul>
                    </div>
                    <InertiaLink href="/" class="btn btn-ghost normal-case text-xl text-primary">
                        {{ $page.props.appName }}
                    </InertiaLink>
                </div>
                <div class="navbar-center hidden lg:flex">
                    <ul class="menu menu-horizontal p-0">
                        <li>
                            <IntertiaLink href="/" class="text-gray-900 dark:text-white">Home</IntertiaLink>
                        </li>
                        <li>
                            <IntertiaLink href="/" class="text-gray-900 dark:text-white">Explore</IntertiaLink>
                        </li>
                    </ul>
                </div>
                <div class="navbar-end">
                    <InertiaLink href="/register" class="btn btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                            <circle cx="12" cy="10" r="3" />
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                    </InertiaLink>
                </div>
            </div>

            <div v-if="$page.props.auth.user !== null" class="sticky top-0 navbar bg-white dark:bg-gray-900 shadow-sm">
                <div class="navbar-start">

                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="#a7081a">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <IntertiaLink href="/home">Home</IntertiaLink>
                            </li>

                            <li>
                                <IntertiaLink href="/">Community</IntertiaLink>
                            </li>
                        </ul>
                    </div>

                    <InertiaLink href="/" class="btn btn-ghost normal-case text-xl text-primary">
                        {{ $page.props.appName }}
                    </InertiaLink>

                    <ul class="menu menu-horizontal p-0 hidden lg:flex">
                        <li>
                            <Link href="/home" class="text-gray-900 dark:text-white">Home</Link>
                        </li>
                        <li>
                            <IntertiaLink href="/" class="text-gray-900 dark:text-white">Explore</IntertiaLink>
                        </li>
                        <li>
                            <IntertiaLink href="/" class="text-gray-900 dark:text-white">Community</IntertiaLink>
                        </li>
                    </ul>

                </div>
                <!-- <div class="navbar-center hidden lg:flex">
                    <div class="form-control w-full">

                    </div>
                </div> -->
                <div class="navbar-end">
                    <Search :filters="$page.props.filters" />

                    <Compose />
                    <!--  <button class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="#a7081a">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button> -->
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <InertiaLink :href="route('profile.show')">
                                    Profile
                                </InertiaLink>
                            </li>
                            <li>
                                <InertiaLink v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')">
                                    API Tokens
                                </InertiaLink>
                            </li>
                            <li>

                                <InertiaLink href="/logout" method="post" type="button" as="button">
                                    Log Out</InertiaLink>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-gray-100 text-gray-100 dark:bg-gray-800 dark:text-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-extrabold"><span
                            class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                            <slot name="header" />
                        </span>
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
