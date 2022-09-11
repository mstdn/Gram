<template>
    <AppLayout title="Upload">
        <template #header>
            Upload
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto px-4 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="columns-1 md:columns-1 lg:columns-1">

                        <div class="card card-compact w-full bg-white dark:bg-gray-800">
                            <div class="card-body">
                                <Upload />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Upload from '../Components/Upload.vue';
export default {
    components: {
    AppLayout,
    Upload
}
}
</script>
