<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import ReplyForm from '../Components/ReplyForm.vue';
import Reply from '../Components/Reply.vue';

let props = defineProps({
    post: Object,
    replies: Object,
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
        <!-- <template #header>
            By <InertiaLink :href="route('user-profile', post.data.username)">
                @{{ post.data.username }}
            </InertiaLink>
        </template> -->

        <div class="py-10 lg:py-20">
            <div class="mx-auto px-4 sm:px-6 lg:px-24">
                <div
                    class="grid grid-cols-1 sm:grid-cols-10 gap-4 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg min-h-[600px] max-h-[900px]">
                    <div class="col-span-7 bg-black rounded-lg lg:rounded-l-lg">
                        <figure>
                            <img :src="post.data.file" class="object-contain w-full center max-h-[600px] rounded-t-lg lg:rounded-l-lg" />
                        </figure>
                    </div>
                    <div class="col-span-7 md:col-span-3">
                        <div class="flex flex-col h-full">
                            <div class="flex justify-between">
                                <div class="flex justify-start mt-4 ml-2">
                                    <div class="avatar">
                                        <div class="w-12 rounded-full">
                                            <InertiaLink :href="route('user-profile', post.data.username)">
                                                <img :src="post.data.avatar" class="w-8" />
                                            </InertiaLink>
                                        </div>
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
                                <div v-if="post.data.can.delete" class="flex justify-end">
                                    <div class="dropdown dropdown-left mt-2 mr-2">
                                        <label tabindex="0" class="btn btn-ghost">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#a7081a" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </label>
                                        <ul tabindex="0"
                                            class="dropdown-content menu p-2 shadow rounded-box w-28 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
                                            <li><a>Edit</a></li>
                                            <li>
                                                <button v-if="post.data.can.delete" @click="destroy(post.data.id)"
                                                    class="btn-link" method="post" type="submit">
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <p class="p-4 text-sm">{{ post.data.description }}</p>

                            <!-- <div v-if="showLess">
                                <div v-for="(value, index) in object">
                                    <template v-if="index <= 5"></template>
                                </div>
                            </div>
                            <div v-else>
                                <div v-for="value in object"></div>
                            </div>
                            <button @click="showLess = false"></button> -->


                            <div class="mt-auto mb-4">
                                <div class="flex justify-between ml-2 mr-2">
                                    <div class="flex justify-start">
                                        <InertiaLink v-if="post.data.can.liked === false" preserveScroll method="post"
                                            as="button" type="button" class="btn btn-ghost btn-sm gap-2"
                                            :href="route('like', { id: post.data.id })">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg>
                                            {{ post.data.likes }}
                                        </InertiaLink>
                                        <InertiaLink v-if="post.data.can.liked === true" preserveScroll method="post"
                                            as="button" type="button" class="btn btn-ghost btn-sm btn-block gap-2"
                                            :href="route('like', { id: post.data.id })">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="#f8e71c" stroke="#f8e71c" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg>
                                            {{ post.data.likes }}
                                        </InertiaLink>
                                        <InertiaLink v-if="$page.props.auth.user === null"
                                            :href="route('show-post', { id: post.data.id })"
                                            class="btn btn-ghost btn-sm btn-block gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg>
                                            {{ post.data.likes }}
                                        </InertiaLink>
                                    </div>
                                    <div class="flex justify-end mr-6">
                                        <!-- The button to open replies modal -->
                                        <label for="repliesModal" class="btn btn-ghost btn-sm modal-button gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#a7081a" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                                </path>
                                            </svg>
                                            {{ post.data.replycount }}
                                        </label>

                                        <!-- Replies modal -->
                                        <input type="checkbox" id="repliesModal" class="modal-toggle" />
                                        <label for="repliesModal" class="modal cursor-pointer">
                                            <label class="modal-box relative bg-white text-gray-900 dark:text-white dark:bg-gray-900" for="">
                                                <label for="repliesModal"
                                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                                <Reply :replies="replies" />
                                                <div class="w-full p-4 md:pr-5">
                                                    <ReplyForm v-if="$page.props.auth.user !== null" :post="post" />
                                                </div>
                                            </label>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="w-full p-4 md:pr-5">
                                <ReplyForm v-if="$page.props.auth.user !== null" :post="post" />
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
