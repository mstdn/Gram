<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import CategoryCard from '../Components/CategoryCard.vue';
import CreateCategory from '../Components/CreateCategory.vue';
import throttle from "lodash/throttle";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
    explore: Object,
    search: Object,
});

let searchCategories = ref(props.search.searchCategories);

watch(
    searchCategories,
    throttle(function (value) {
        Inertia.get(
            "/explore",
            { searchCategories: value },
            {
                preserveState: true,
                replace: true,
                preserveScroll: true
            }
        );
    }, 500)
);

</script>
<template>
    <AppLayout title="Browse Categories">
        <template #header>
            <div class="flex justify-between">
                <div class="flex justify-start text-gray-900 dark:text-white">
                    Browse Categories
                </div>
                <div class="flex justify-end">
                    <CreateCategory v-if="$page.props.auth.user !== null && $page.props.auth.user.id === 1" />
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <div class="columns-1 gap-6 mb-6 ">
                        <input type="text" v-model="searchCategories" placeholder="Search categories"
                            class="input input-bordered input-primary w-full 
                            md:max-w-xs bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white
                            focus:border-transparent focus:ring-0
                            " />
                    </div>

                    <div class="columns-1 md:columns-3 lg:columns-4">
                        <CategoryCard class="mb-4" v-for="category in explore.data" :key="category.id"
                            :category="category" />
                    </div>

                    <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="explore.meta.total >= 13" :data="explore.links" />
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
