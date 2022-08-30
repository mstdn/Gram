<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PostCard from '../Components/PostCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';

let props = defineProps({
    posts: Object,
    category: String,
});

</script>
<template>
    <AppLayout title="Explore &amp; Discover Gram Social">
        <template #header>
            {{ category }}
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="columns-1 md:columns-3 lg:columns-4">

                        <PostCard class="mb-4" v-for="post in posts.data" :key="post.id" :post="post" />
                        
                    </div>

                   <!--  <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />
                    </div> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
