<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostCard from '../Components/PostCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import Empty from '../Components/Empty.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';

let props = defineProps({
    posts: Object,
    profile: Object,
    filters: Object,
});

</script>
<template>
    <AppLayout title="User Profile">


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mr-4 mt-4">
                    <InertiaLink
                        v-if="$page.props.auth.user !== null && profile.data.is.following === false && profile.data.is.self === false"
                        preserveScroll method="post" as="button" type="button" class="btn btn-primary gap-2 mt-2"
                        :href="route('follow', { id: profile.data.username })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <div class="hidden sm:block">Follow</div>
                    </InertiaLink>
                    <InertiaLink
                        v-if="$page.props.auth.user !== null && profile.data.is.following === true && profile.data.is.self === false"
                        preserveScroll method="post" as="button" type="button" class="btn btn-secondary gap-2 mt-2"
                        :href="route('follow', { id: profile.data.username })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        <div class="hidden sm:block">Unfollow</div>
                    </InertiaLink>
                </div>
                <div class="flex justify-center">
                    <div class="avatar">
                        <div class="w-32 rounded-full">
                            <img :src="profile.data.avatar" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-3">
                    <h2 class="text-3xl font-extrabold">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                            {{ profile.data.name }}
                        </span>
                    </h2>
                </div>
                <div class="flex justify-center">
                    <p class="text-sm font-bold">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                            @{{ profile.data.username }}
                        </span>
                    </p>
                </div>
                <div class="flex justify-center mt-6">
                    <ul
                        class="menu menu-vertical lg:menu-horizontal bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white rounded-box">
                        <li>
                            <InertiaLink preserve-scroll :href="route('user-profile', profile.data.username)"
                                :active="route().current('user-profile', profile.data.username)">
                                {{ profile.data.postcount }} Posts
                            </InertiaLink>
                        </li>
                        <li>
                            <InertiaLink preserve-scroll :href="route('user-profile', profile.data.username)"
                                :active="route().current('user-profile', profile.data.username)">
                                0 Boards
                            </InertiaLink>
                        </li>
                        <li>
                            <InertiaLink preserve-scroll :href="route('user-profile', profile.data.username)"
                                :active="route().current('user-profile', profile.data.username)">
                                {{ profile.data.followings }} Following
                            </InertiaLink>
                        </li>
                        <li>
                            <InertiaLink preserve-scroll :href="route('user-profile', profile.data.username)"
                                :active="route().current('user-profile', profile.data.username)">
                                {{ profile.data.followers }} Followers
                            </InertiaLink>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <TabGroup>
                        <TabList class="text-center flex space-x-1 bg-gray-200 dark:bg-gray-800 rounded-lg">
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary' : 'btn btn-primary btn-active']">
                                    Posts
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary' : 'btn btn-primary btn-active']">
                                    Liked
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary' : 'btn btn-primary btn-active']">
                                    Shared
                                </button>
                            </Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel>

                                <Empty v-if="posts.meta.total === 0" class="columns-1 mt-20" />

                                <div class="columns-1 md:columns-3 lg:columns-4">
                                    <PostCard class="mb-4" v-for="post in posts.data" :key="post.id" :post="post" />
                                </div>

                                <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                                    <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />
                                </div>

                            </TabPanel>
                            <TabPanel>
                                <div class="px-4 mx-auto max-w-screen-xl">
                                    <div class="mx-auto max-w-screen-sm text-center p-10">

                                        Soon.

                                    </div>
                                </div>
                            </TabPanel>
                            <TabPanel>
                                <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
                                    <div class="mx-auto max-w-screen-sm text-center p-10">

                                        Soon.

                                    </div>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>



                </div>
            </div>
        </div>
    </AppLayout>
</template>
