<template>
    <div class="py-2">
        <p v-for="reply in post.data.replies" :key="reply.id"
        class="p-2 pl-3 mr-2 border border-gray-600 rounded-full">{{reply.reply }}</p>
    </div>
</template>
<script setup>
let props = defineProps({
    post: Object,
});
</script>
