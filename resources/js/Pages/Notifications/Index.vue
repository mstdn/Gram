<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { debounce } from "lodash/function";
import NotificationsCard from '../Components/NotificationsCard.vue';
import Empty from '../Components/Empty.vue';

export default {
    props: {
        notifications: Object,
    },
    data() {
        return {
            userNotifications: this.notifications
        }
    },
    components: {
    AppLayout,
    NotificationsCard,
    Empty
},
    mounted() {
        window.addEventListener('scroll', debounce((e) => {
            let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;

            if (pixelsFromBottom < 100) {

                axios.get(this.userNotifications.next_page_url).then(response => {
                    this.userNotifications = {
                        ...response.data,
                        data: [...this.userNotifications.data, ...response.data.data]
                    }
                });
            }
        }, 200));
    },
    watch: {
        posts(newNotifications) {
            this.userNotifications = newNotifications;
        }
    }
}
</script>
<template>
    <AppLayout title="Notifications">
        <template #header>
            Notifications
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <Empty v-if="userNotifications.total === 0" class="columns-1 mt-20" />

                    <div class="columns-1 md:columns-1 lg:columns-1">
                        <NotificationsCard class="mb-4" v-for="notification in userNotifications.data"
                            :key="notification.id" :notification="notification" />
                    </div>

                   <!--  <div class="columns-1 md:columns-1 lg:columns-1 mt-6">

                        <div class="flex justify-center my-10" v-if="notifications.total >= 16">
                            <div class="btn-group">
                                <InertiaLink v-if="notifications.prev_page_url !== null"
                                    :href="notifications.prev_page_url" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="11 19 2 12 11 5 11 19"></polygon>
                                        <polygon points="22 19 13 12 22 5 22 19"></polygon>
                                    </svg>
                                </InertiaLink>
                                <button v-else class="btn btn-primary btn-disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#e2e2e2" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="11 19 2 12 11 5 11 19"></polygon>
                                        <polygon points="22 19 13 12 22 5 22 19"></polygon>
                                    </svg>
                                </button>
                                <InertiaLink v-if="notifications.next_page_url !== null"
                                    :href="notifications.next_page_url" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="13 19 22 12 13 5 13 19"></polygon>
                                        <polygon points="2 19 11 12 2 5 2 19"></polygon>
                                    </svg>
                                </InertiaLink>
                                <button v-else class="btn btn-primary btn-disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#e2e2e2" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="13 19 22 12 13 5 13 19"></polygon>
                                        <polygon points="2 19 11 12 2 5 2 19"></polygon>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
    