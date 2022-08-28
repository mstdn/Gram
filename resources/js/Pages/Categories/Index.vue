<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import CategoryCard from '../Components/CategoryCard.vue';

let props = defineProps({
    posts: Object,
    explore: Object,
});

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            Browse Categories
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="columns-1 md:columns-3 lg:columns-4">

                        <CategoryCard class="mb-4" v-for="category in explore.data" :key="category.id" :category="category" />
                        
                    </div>

                   <!--  <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />
                    </div> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
