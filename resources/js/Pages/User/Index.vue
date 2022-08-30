<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import CategoryCard from '../Components/CategoryCard.vue';
import CreateCategory from '../Components/CreateCategory.vue';
import throttle from "lodash/throttle";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import UserCard from '../Components/UserCard.vue';

let props = defineProps({
    profiles: Object,
    search: Object,
});

let searchUsers = ref(props.search.searchUsers);

watch(
    searchUsers,
    throttle(function (value) {
        Inertia.get(
            "/community",
            { searchUsers: value },
            {
                preserveState: true,
                replace: true,
                preserveScroll: true
            }
        );
    }, 500)
);

</script>
<template>
    <AppLayout title="Community">
        <template #header>
            Community
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <div class="columns-1 gap-6 mb-6 ">
                        <input type="text" v-model="searchUsers" placeholder="Search the community"
                            class="input input-bordered input-primary w-full 
                            md:max-w-xs bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white
                            focus:border-transparent focus:ring-0
                            " />
                    </div>

                    <div class="columns-1 md:columns-2 lg:columns-3">
                        <UserCard class="mb-4" v-for="profile in profiles.data" :key="profile.id"
                            :profile="profile" />
                    </div>

                    <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="profiles.meta.total >= 15" :data="profiles.links" />
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
