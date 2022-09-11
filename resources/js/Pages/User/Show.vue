<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostCard from '../Components/PostCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import Empty from '../Components/Empty.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import ProfileCard from '../Components/ProfileCard.vue';

let props = defineProps({
    posts: Object,
    profile: Object,
    filters: Object,
    likes: Object,
});

</script>
<template>
    <AppLayout title="User Profile">

        <ProfileCard :profile="profile" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <TabGroup>
                        <TabList class="text-center flex space-x-1 rounded-lg btn-group">
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary btn-sm' : 'btn btn-primary btn-active btn-sm']">
                                    Posts
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary btn-sm' : 'btn btn-primary btn-active btn-sm']">
                                    Liked
                                </button>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[selected ? 'btn btn-primary btn-sm' : 'btn btn-primary btn-active btn-sm']">
                                    Shared
                                </button>
                            </Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel>

                                <Empty v-if="posts.meta.total === 0" class="columns-1 mt-20" />

                                <div class="columns-1 md:columns-3 lg:columns-4 mt-6">
                                    <PostCard class="mb-4" v-for="post in posts.data" :key="post.id" :post="post" />
                                </div>

                                <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                                    <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />
                                </div>

                            </TabPanel>
                            <TabPanel>
                                <Empty v-if="likes.total === 0" class="columns-1 mt-20" />

                                <div class="columns-1 md:columns-3 lg:columns-4 mt-6">
                                    <PostCard class="mb-4" v-for="like in likes.data" :key="like.id" :post="like" />
                                </div>

                                <!-- <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                                    <SimplePagination v-if="likes.meta.total >= 15" :data="likes.links" />
                                </div> -->
                            </TabPanel>
                            <TabPanel>
                                <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
                                    <div class="mx-auto max-w-screen-sm text-center p-10">

                                        Soon. meow.

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
