<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Compose from '../Components/Compose.vue';
import PostCard from '../Components/PostCard.vue';

let props = defineProps({
    post: Object,
});

const form = useForm();
function destroy(id) {
    if (confirm("Are you sure you want to delete?")) {
        form.delete(route('post.destroy', id));
    }
};
</script>
<template>
    <AppLayout title="Post">
        <template #header>
            By <InertiaLink :href="route('user-profile', post.data.username)">
                @{{ post.data.username }}
            </InertiaLink>
        </template>

        <div class="py-10">
            <div class="mx-auto px-4 sm:px-6 lg:px-24">
                <div class="grid grid-cols-1 sm:grid-cols-10 gap-4 bg-gray-100 rounded-lg">
                    <div class="col-span-7">
                        <figure>
                            <img :src="post.data.file" class="h-full w-full max-h-screen rounded-l-lg" />
                        </figure>
                    </div>
                    <div class="col-span-3">
                        <div>
                            <div class="avatar mt-4 ml-4">
                                <div class="w-12 rounded-full">
                                    <InertiaLink :href="route('user-profile', post.data.username)">
                                        <img :src="post.data.avatar" />
                                    </InertiaLink>
                                </div>
                                <div>
                                    <div class="ml-3 font-bold text-lg">
                                        <InertiaLink :href="route('user-profile', post.data.username)">
                                            {{ post.data.name }}
                                        </InertiaLink>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <InertiaLink :href="route('user-profile', post.data.username)">
                                            @{{ post.data.username }}
                                        </InertiaLink>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="p-4">{{ post.data.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
