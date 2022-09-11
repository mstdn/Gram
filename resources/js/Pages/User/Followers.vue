<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Empty from '../Components/Empty.vue';
import ProfileCard from '../Components/ProfileCard.vue';
import UserCard from '../Components/UserCard.vue';
import SimplePagination from '../Components/SimplePagination.vue';

let props = defineProps({
    profile: Object,
    followers: Object,
});

</script>
        <template>
    <AppLayout title="User Followers">

        <ProfileCard :profile="profile" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <Empty v-if="followers.meta.total === 0" />

                    <div class="columns-1 md:columns-2 lg:columns-3">
                        <UserCard class="mb-4" v-for="profile in followers.data" :key="profile.id" :profile="profile" />
                    </div>

                    <div class="columns-1 md:columns-1 lg:columns-1 mt-6">
                        <SimplePagination v-if="followers.meta.total >= 15" :data="followers.links" />
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
        