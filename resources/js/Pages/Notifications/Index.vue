<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SimplePagination from '../Components/SimplePagination.vue';
import NotificationsCard from "../Components/NotificationsCard.vue";

let props = defineProps({
    notifications: Object,
    search: Object,
});


</script>
    <template>
    <AppLayout title="Notifications">
        <template #header>
            Notifications
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <div class="columns-1 md:columns-1 lg:columns-1">
                        <NotificationsCard class="mb-4" v-for="notification in notifications.data" :key="notification.id"
                            :notification="notification" />
                    </div>

                    <!-- <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="notifications.meta.total >= 13" :data="notifications.links" />
                    </div> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
    