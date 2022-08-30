<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import throttle from "lodash/throttle";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import Compose from '../Components/Compose.vue';
import PostCard from '../Components/PostCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';

let props = defineProps({
    posts: Object,
    filters: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    throttle(function (value) {
        Inertia.get(
            "/home",
            { search: value },
            {
                preserveState: true,
                replace: true,
                preserveScroll: true
            }
        );
    }, 500)
);

const form = useForm();
function destroy(id) {
    if (confirm("Are you sure you want to delete?")) {
        form.delete(route('post.destroy', id));
    }
};
</script>
<template>
    <AppLayout title="Home Feed">
        <template #header>
            Home Feed
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="columns-1 md:columns-3 lg:columns-4">

                        <PostCard class="mb-4" v-for="post in posts.data" :key="post.id" :post="post" />
                        
                    </div>

                    <div class="columns-1 md:columns-1 lg:columns-1 mt-6">

                        <SimplePagination v-if="posts.meta.total >= 15" :data="posts.links" />

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
