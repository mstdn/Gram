<template>
    <div>
        <div class="card card-compact dark:bg-gray-800 dark:text-white bg-gray-100 text-gray-900">
            <div class="card-body">
                <div class="flex justify-between">
                    <h2 class="card-title">
                        <InertiaLink :href="route('user-profile', { id: profile.username })">
                            <div class="avatar">
                                <div class="w-14 rounded-full">
                                    <img :src="profile.avatar" />
                                </div>
                            </div>
                        </InertiaLink>
                        <div class="ml-2 mb-2 text-sm">
                            <InertiaLink :href="route('user-profile', { id: profile.username })">
                                {{ profile.name }}
                                <div class="text-sm">
                                    @{{ profile.username }}
                                </div>
                            </InertiaLink>
                        </div>
                    </h2>
                    <InertiaLink
                        v-if="$page.props.auth.user !== null && profile.is.following === false && profile.is.self === false"
                        preserveScroll method="post" as="button" type="button" class="btn btn-primary btn-sm gap-2 mt-2"
                        :href="route('follow', { id: profile.username })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </InertiaLink>
                    <InertiaLink
                        v-if="$page.props.auth.user !== null && profile.is.following === true && profile.is.self === false"
                        preserveScroll method="post" as="button" type="button" class="btn btn-secondary btn-sm gap-2 mt-2"
                        :href="route('follow', { id: profile.username })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </InertiaLink>
                </div>
                <p class="my-4">{{ profile.about }}</p>
                
                <div class="card-actions">
                    <InertiaLink preserve-scroll class="btn-link"
                        :href="route('user-profile', { id: profile.username })">
                        {{ profile.postcount }} Posts
                    </InertiaLink>
                    <InertiaLink preserve-scroll class="btn-link ml-2"
                        :href="route('follows', { id: profile.username })">
                        {{ profile.followings }} Follows
                    </InertiaLink>
                    <InertiaLink preserve-scroll class="btn-link ml-2"
                        :href="route('followers', { id: profile.username })">
                        {{ profile.followers }} Followers
                    </InertiaLink>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
let props = defineProps({
    profile: Object,
});

</script>