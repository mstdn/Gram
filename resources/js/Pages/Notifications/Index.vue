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

                </div>
            </div>
        </div>
    </AppLayout>
</template>
    