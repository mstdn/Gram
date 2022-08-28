<template>
    <div>
        <div class="card w-full bg-base-100 shadow">
            <div class="card-body items-center">
                <h1 class="card-title text-3xl font-extrabold">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-red-500 from-red-800">
                        <InertiaLink :href="route('show-category', category.slug)">
                            {{ category.name }}
                        </InertiaLink>
                    </span>
                </h1>
                <p class="text-center py-2">{{ category.count }} total posts.</p>
                <div class="card-actions justify-center">
                    <InertiaLink :href="route('show-category', category.slug)" class="btn btn-primary btn-block">Browse
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
