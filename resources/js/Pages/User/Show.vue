<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostCard from '../Components/PostCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';

let props = defineProps({
    posts: Object,
    profile: Object,
    filters: Object,
});

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            {{ profile.data.name }}
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            @{{ profile.data.username }}
                        </span>
                    </h2>
                </div>
            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <div class="columns-1 md:columns-3 lg:columns-4">
                        <PostCard class="mb-4" v-for="post in profile.data.posts" :key="post.id" :post="post" />
                    </div>

                    <!-- <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />
                    </div> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
