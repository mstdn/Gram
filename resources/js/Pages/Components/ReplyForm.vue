<template>
    <div>
        <form @submit.prevent="submit">
            <label for="reply" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Your
                Reply</label>
            <div class="relative">

                <input type="text" v-model="form.reply" id="reply"
                    class="input p-4 w-full text-sm text-gray-900 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white"
                    placeholder="Type your reply">
                <button type="submit" :disabled="form.processing" class="absolute right-2.5 bottom-2.5 px-4 py-2 btn btn-sm">Reply</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from 'vue';

let props = defineProps({
    post: Object,
});


const characterCount = computed(() => {
    return form.reply.length
})

let form = useForm({
    reply: "",
});

let submit = () => {
    form.post(route('reply', { id: props.post.data.id }), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => form.reset("reply"),
    });
};

function destroy(id) {
    if (confirm("Are you sure you want to delete?")) {
        form.delete(route('reply.destroy', id));
    }
}
</script>
