<template>
    <div class="py-8">
        <ol class="relative border-l border-gray-200 dark:border-gray-700">
            <li v-for="reply in post.data.replies" :key="reply.id" class="mb-10 ml-6">
                <span
                    class="flex absolute -left-3 justify-center items-center w-8 h-8 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                    <img class="rounded-full" :src="reply.avatar" alt="{{ reply.username }}">
                </span>
                <div
                    class="justify-between items-center p-4 bg-white rounded-lg border border-gray-200 shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
                    <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ reply.time }}</time>

                    <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                        {{ reply.reply }}
                    </div>
                </div>
            </li>
        </ol>
    </div>
</template>
<script setup>
let props = defineProps({
    post: Object,
});
</script>
