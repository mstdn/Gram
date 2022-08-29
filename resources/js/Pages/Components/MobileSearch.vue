<template>
        <input v-model="search" type="text" placeholder="Search for cool stuff"
            class="flex input input-bordered rounded-full input-sm h-10 w-full mr-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-white" />
</template>
<script setup>
import throttle from "lodash/throttle";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';

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
</script>