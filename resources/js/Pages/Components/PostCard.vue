<template>
    <div>
        <div class="filter hover:brightness-[80%]">
            <img @click="openModal" class="rounded h-full w-full hover:" :src="post.file" />
        </div>
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-60">
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
                                        <InertiaLink class="ml-2 mt-1"
                                            :href="route('user-profile', { id: post.username })">
                                            @{{ post.username }}
                                        </InertiaLink>
                                        <div class="m-1">・</div>
                                        <InertiaLink class="ml-1 mt-1" :href="route('show-post', { id: post.id })">
                                            {{ post.time }}
                                        </InertiaLink>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" class="btn btn-primary btn-sm" @click="closeModal">
                                            Close
                                        </button>
                                    </div>
                                </DialogTitle>
                                <div class="mt-2">
                                    <InertiaLink :href="route('show-post', { id: post.id })">
                                        <img class="rounded-2xl object-fill h-full w-full" :src="post.file" alt="" />
                                    </InertiaLink>
                                </div>
                                <div class="mt-2">
                                    <p>{{ post.description }}</p>
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
