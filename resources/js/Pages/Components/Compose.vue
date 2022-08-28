<template>
    <button type="button" @click="openModal" class="btn btn-circle btn-ghost mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="#a7081a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3" />
        </svg>
    </button>

    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-md bg-white text-gray-900 dark:bg-gray-800 dark:text-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-gray-900 flex justify-between">
                                <div
                                    class="flex justify-start text-lg font-medium leading-6 mb-2 text-gray-900 dark:text-white">
                                    Upload a post
                                </div>
                                <div class="flex justify-end text-sm text-gray-900 dark:text-white">
                                    {{ characterCount }}/500
                                </div>
                            </DialogTitle>
                            <form @submit.prevent="submit">
                                <div class="mt-2">

                                    <label
                                        class="flex flex-col w-full h-32 border-4 border-primary border-dashed  hover:bg-gray-300 hover:border-secondary">
                                        <div class="flex flex-col items-center justify-center pt-7">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-8 h-8 text-gray-400 dark:group-hover:text-gray-400 group-hover:text-gray-200"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p
                                                class="pt-1 text-sm tracking-wider text-gray-400 dark:group-hover:text-gray-900 group-hover:text-gray-300">
                                                Upload image(max 10MB)</p>
                                            <progress v-if="form.progress" class="progress progress-success w-56 m-1"
                                                :value="form.progress.percentage" max="100">
                                                {{ form.progress.percentage }}%
                                            </progress>
                                        </div>
                                        <input type="file" @input="form.file = $event.target.files[0]" name="file"
                                            id="file" class="opacity-0" />
                                    </label>
                                    <div v-if="form.errors.file" v-text="form.errors.file" class="text-red-500 mt-1">
                                    </div>

                                </div>
                                <div class="mt-4">
                                    <resize-textarea v-model="form.description" :rows="2" :maxHeight="200"
                                        class="textarea textarea-primary w-full focus:border-transparent focus:ring-0 bg-white text-gray-900 dark:bg-gray-900 dark:text-white"
                                        placeholder="Add a description"></resize-textarea>
                                </div>
                                <div v-if="form.errors.description" v-text="form.errors.description"
                                    class="text-red-500 mt-2"></div>
                                <div class="mt-4">
                                    <div class="flex justify-between">
                                        <select v-model="form.category" name="category" id="category"
                                            class="select select-bordered w-full bg-white text-gray-900 dark:bg-gray-900 dark:text-white">
                                            <option disabled value="">Category</option>
                                            <option v-for="category in $page.props.categories" :key="category.id"
                                                :value="category.id" selected>{{ category.name }}</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="mt-4">
                                    <div class="flex justify-between">
                                        <div class="flex justify-start">
                                            <button type="button" class="btn btn-error" @click="closeModal">
                                                Close
                                            </button>
                                        </div>
                                        <div class="flex justify-end">
                                            <button class="btn btn-success" type="submit" :disabled="form.processing">
                                                Create
                                            </button>

                                        </div>
                                    </div>

                                </div>

                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from 'vue';

let props = defineProps({
    categories: Object,
});

const characterCount = computed(() => {
    return form.description.length
});

let form = useForm({
    description: "",
    file: "",
    category: "1",
});

let submit = () => {
    form.post(route('store.post'), {
        forceFormData: true,
        onSuccess: () => [
            form.reset("description", "category", "file"),
            isOpen.value = false
        ],
    });
};

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}
</script>
