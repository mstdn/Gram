<script setup>
defineProps({
    policy: String,
});
</script>

<template>
    <AppLayout title="Privacy Policy">
        <div class="text-gray-900 dark:text-white">
            <div class="pt-4 bg-white dark:bg-gray-900">
                <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                    <div class="w-full sm:max-w-2xl mt-6 p-6 bg-gray-100 shadow-md overflow-hidden sm:rounded-lg prose"
                        v-html="policy" />
                </div>
            </div>
        </div>
    </AppLayout>

</template>
