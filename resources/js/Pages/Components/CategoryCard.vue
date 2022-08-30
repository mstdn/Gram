<template>
    <div>
        <div class="card card-compact w-full bg-gray-100 dark:bg-gray-800 shadow">
            <div class="card-body items-center">
                <h1 class="card-title text-3xl font-extrabold">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                        <InertiaLink :href="route('show-category', category.slug)">
                            {{ category.name }}
                        </InertiaLink>
                    </span>
                </h1>
                <p class="text-center py-6 text-gray-900 dark:text-white">{{ category.count }} total posts.</p>
                <div class="card-actions justify-center">
                    <InertiaLink :href="route('show-category', category.slug)" class="btn btn-outline btn-warning btn-wide btn-xs">Browse
                        {{ category.name }}</InertiaLink>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>

let props = defineProps({
    category: Object,
});
</script>
