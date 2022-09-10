<template>
    <div>
        <div class="filter hover:brightness-[80%]">
            <img @click="openModal" class="rounded h-full w-full hover:" :src="post.file" />
        </div>
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-50">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full z-60 lg:max-w-[50%] max-w-[95%] md:max-w-[65%] lg:max-h-[45%] sm:max-h-[60%] transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-4 text-left align-middle shadow-xl transition-all">
                                <DialogTitle as="h3"
                                    class="flex justify-between text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    <div class="flex justify-start">
                                        <img class="inline-block h-9 w-9 rounded-full" :src="post.avatar" alt="" />
                                        <InertiaLink class="ml-2 mt-1 hover:underline"
                                            :href="route('user-profile', { id: post.username })">
                                            @{{ post.username }}
                                        </InertiaLink>
                                        <div class="m-1">・</div>
                                        <InertiaLink class="ml-1 mt-1 hover:underline" :href="route('show-post', { id: post.id })">
                                            {{ post.time }}
                                        </InertiaLink>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" class="btn btn-primary btn-sm" @click="closeModal">
                                            Close
                                        </button>
                                    </div>
                                </DialogTitle>
                                <div class="mt-4">
                                    <InertiaLink :href="route('show-post', { id: post.id })">
                                        <img class="rounded-2xl object-fill h-full w-full" :src="post.file" alt="" />
                                    </InertiaLink>
                                </div>
                                <div class="mt-4 p-4">
                                    <p class="text-gray-900 dark:text-white">{{ post.description }}</p>
                                </div>

                                <div class="mt-6">
                                    <div class="divider"></div>
                                    <div class="flex justify-between">
                                        <div>
                                            <InertiaLink :href="`/explore/${post.category_slug}`" class="btn btn-sm">
                                                {{ post.category }}
                                            </InertiaLink>
                                        </div>
                                        <div class="flex">
                                            <div>
                                                <InertiaLink v-if="post.can.liked === false" preserveScroll
                                                    method="post" as="button" type="button"
                                                    class="btn btn-ghost btn-sm gap-2"
                                                    :href="route('like', { id: post.id })">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                    {{ post.likes }}
                                                </InertiaLink>
                                                <InertiaLink v-if="post.can.liked === true" preserveScroll method="post"
                                                    as="button" type="button"
                                                    class="btn btn-ghost btn-sm btn-block gap-2"
                                                    :href="route('like', { id: post.id })">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="#f8e71c" stroke="#f8e71c"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                    {{ post.likes }}
                                                </InertiaLink>
                                                <InertiaLink v-if="$page.props.auth.user === null"
                                                    :href="route('show-post', { id: post.id })"
                                                    class="btn btn-ghost btn-sm btn-block gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                    {{ post.likes }}
                                                </InertiaLink>
                                            </div>
                                            <div>

                                                <button class="btn btn-ghost btn-sm btn-block gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="#a7081a"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                                        </path>
                                                    </svg>
                                                    {{ post.replycount }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue';
import Reply from './Reply.vue';
import ReplyForm from './ReplyForm.vue';

let props = defineProps({
    post: Object,
});

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}
</script>
