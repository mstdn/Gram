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
    <AppLayout title="Dashboard">
        <template #header>
            <Compose v-if="$page.props.auth.user !== null" />
            <div v-if="$page.props.auth.user === null" class="text-gray-900 dark:text-white">Home</div>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-24">
                <div class="overflow-hidden sm:rounded-lg"> 

                    <div class="card lg:card-side bg-base-100 z-0">
                        <figure>
                            <img :src="post.data.file" class="h-full w-full max-h-screen" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ post.data.description }}
                            </h2>
                            
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">{{ post.data.category }}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
