<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Search from '../Pages/Components/Search.vue';
import PublicSearch from '../Pages/Components/PublicSearch.vue';
import Mobile from '../Pages/Components/Mobile.vue';
import MobileSearch from '../Pages/Components/MobileSearch.vue';
import Footer from '../Pages/Components/Footer.vue';
import NotiCheck from '../Pages/Components/NotiCheck.vue';

export default {
    components: {
    Head,
    Link,
    JetBanner,
    Search,
    PublicSearch,
    Mobile,
    MobileSearch,
    Footer,
    NotiCheck
},
    props: {
        title: String
    },
    created() {
        if(this.$page.props.auth.user !== null) {
            window.Echo.private(`App.Models.User.${this.$page.props.user.id}`)
            .notification((notification) => {
                console.log(notification);
            });
        }
    }
}

</script>

<template>
    <div>

        <Head :title="title" />

        <JetBanner />
        <!-- <NotiCheck v-if="$page.props.auth.user !== null" /> -->

        <div class="bg-white dark:bg-gray-900">
            <div v-if="$page.props.auth.user === null"
                class="sticky top-0 z-50 navbar bg-white dark:bg-gray-900 dark:border-b-[1px] dark:border-gray-800 border-b-[1px] border-gray-200">
                <div class="navbar-start ">
                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost btn-circle lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="#a7081a">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white rounded-box w-52">
                            <li>
                                <Link :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/' }" href="/">
                                Browse
                                </Link>
                            </li>
                            <li>
                                <Link href="/community"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/community' }">
                                Community
                                </Link>
                            </li>
                            <!-- <li>
                                <Link href="/login" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/login' }">
                                Login
                                </Link>
                            </li>
                            <li>
                                <Link href="/register"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/register' }">
                                Register
                                </Link>
                            </li> -->
                            <li>
                                <Link href="/terms-of-service"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/terms-of-service' }">
                                Terms of Service
                                </Link>
                            </li>
                            <li>
                                <Link href="/privacy-policy"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/privacy-policy' }">
                                Privacy Policy
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <InertiaLink href="/" class="btn btn-ghost normal-case text-xl text-primary">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                            {{ $page.props.appName }}
                        </span>
                    </InertiaLink>

                    <div class="menu menu-horizontal p-0 hidden lg:flex">
                        <Link href="/"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                            <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                        </svg>
                        </Link>
                        <Link href="/explore"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/explore*' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="9" x2="20" y2="9"></line>
                            <line x1="4" y1="15" x2="20" y2="15"></line>
                            <line x1="10" y1="3" x2="8" y2="21"></line>
                            <line x1="16" y1="3" x2="14" y2="21"></line>
                        </svg>
                        </Link>
                        <Link href="/community"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/community' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        </Link>
                        <div class="dropdown">
                            <label tabindex="0"
                                class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="#a7081a" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </label>
                            <ul tabindex="0"
                                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white text-gray-900 rounded-box w-48">
                                <li>
                                    <InertiaLink href="/"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/' }">
                                        About
                                    </InertiaLink>
                                </li>
                                <li>
                                    <InertiaLink href="/terms-of-service"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/terms-of-service' }">
                                        Terms of Service
                                    </InertiaLink>
                                </li>
                                <li>
                                    <InertiaLink href="/privacy-policy"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/privacy-policy' }">
                                        Privacy Policy
                                    </InertiaLink>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--  <div class="navbar-center hidden lg:flex">
                </div> -->

                <div class="navbar-end">
                    <PublicSearch :filters="$page.props.filters" />

                    <InertiaLink href="/login" class="btn btn-circle btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M13.8 12H3" />
                        </svg>
                    </InertiaLink>
                    <InertiaLink href="/register" class="btn btn-circle btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </InertiaLink>
                </div>
            </div>

            <div v-if="$page.props.auth.user !== null"
                class="sticky top-0 z-50 navbar bg-white dark:bg-gray-900 dark:border-b-[1px] dark:border-gray-800 border-b-[1px] border-gray-200">
                <div class="navbar-start">

                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost btn-circle lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="#a7081a">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white rounded-box w-52">
                            <li>
                                <Link :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/home' }" href="/home">
                                Home
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('public')"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/public' }">
                                Public
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('categories')"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/explore' }">
                                Explore
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('community')"
                                    :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/community' }">
                                Community
                                </Link>
                            </li>
                            <li tabindex="0">
                                <a class="justify-between">
                                    More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 18l6-6-6-6" />
                                    </svg>
                                </a>
                                <ul class="p-2 bg-white dark:bg-gray-900 dark:text-white">
                                    <li>
                                        <Link href="/"
                                            :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/about' }">
                                        About
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="/terms-of-service"
                                            :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/terms-of-service' }">
                                        Terms of Service
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="/privacy-policy"
                                            :class="{ 'bg-gray-100 dark:bg-gray-700': $page.url === '/privacy-policy' }">
                                        Privacy Policy
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <InertiaLink href="/" class="btn btn-ghost normal-case text-xl text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="8.5" r="5.5" />
                            <path d="M11.5 14v7" />
                        </svg>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-400 from-red-700 ml-2">
                            {{ $page.props.appName }}
                        </span>
                    </InertiaLink>

                    <div class="menu menu-horizontal p-0 hidden lg:flex ml-3">
                        <Link href="/home"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/home' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                            <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                        </svg>
                        </Link>
                        <Link href="/public"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/public' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="9" x2="20" y2="9"></line>
                            <line x1="4" y1="15" x2="20" y2="15"></line>
                            <line x1="10" y1="3" x2="8" y2="21"></line>
                            <line x1="16" y1="3" x2="14" y2="21"></line>
                        </svg>
                        </Link>
                        <Link href="/explore"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/explore' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        </Link>
                        <Link href="/community"
                            :class="{ 'btn btn-circle btn-ghost bg-gray-100 dark:bg-gray-800': $page.url === '/community' }"
                            class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        </Link>
                        <div class="dropdown">
                            <label tabindex="0"
                                class="btn btn-circle btn-ghost hover:bg-gray-100 hover:dark:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="#a7081a" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </label>
                            <ul tabindex="0"
                                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white text-gray-900 rounded-box w-48">
                                <li>
                                    <InertiaLink href="/"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/' }">
                                        About
                                    </InertiaLink>
                                </li>
                                <li>
                                    <InertiaLink href="/terms-of-service"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/terms-of-service' }">
                                        Terms of Service
                                    </InertiaLink>
                                </li>
                                <li>
                                    <InertiaLink href="/privacy-policy"
                                        class="btn-link btn-block hover:bg-gray-100 hover:dark:bg-gray-800"
                                        :class="{ 'btn-link btn-block bg-gray-200 dark:bg-gray-700': $page.url === '/privacy-policy' }">
                                        Privacy Policy
                                    </InertiaLink>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- <div class="navbar-center hidden lg:flex">
                    <div class="form-control w-full">

                    </div>
                </div> -->
                <div class="navbar-end">
                    <Search :filters="$page.props.filters" />

                    <!-- <Compose /> -->

                    <!-- <UploadModal /> -->

                    <InertiaLink href="/upload" class="btn btn-circle btn-ghost md:mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" />
                        </svg>
                    </InertiaLink>

                    <InertiaLink :href="route('notifications')" class="btn btn-ghost btn-circle md:mr-2">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="#a7081a">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="badge badge-xs badge-success indicator-item">
                                {{ $page.props.unreadNotificationsCount }}
                            </span>
                        </div>
                    </InertiaLink>

                    <div class="dropdown dropdown-left lg:hidden md:hidden">
                        <label tabindex="0" class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="#a7081a" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </label>
                        <div tabindex="0"
                            class="dropdown-content card card-compact w-64 p-1 shadow bg-white dark:bg-gray-900 text-primary-content">
                            <MobileSearch :filters="$page.props.filters" />
                        </div>
                    </div>


                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white rounded-box w-52">
                            <li>
                                <InertiaLink :href="route('user-profile', $page.props.user.username)">
                                    Profile
                                </InertiaLink>
                            </li>
                            <li>
                                <InertiaLink :href="route('profile.show')">
                                    Settings
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
            <header v-if="$slots.header" class="bg-gray-100 text-gray-100 dark:bg-gray-800 dark:text-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-extrabold"><span
                            class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                            <slot name="header" />
                        </span>
                    </h2>
                </div>
            </header>

            <main>
                <slot />
            </main>

            <Mobile class="pt-10 z-10" />
            <Footer class="mt-auto hidden md:flex" />
        </div>
    </div>
</template>
