<template>
    <div>
        <div class="alert bg-white text-gray-900 dark:bg-gray-900 dark:text-white">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-info flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-bold">It's empty!</h3>
                    <div class="text-xs">There are no posts here yet.</div>
                </div>
            </div>
            <div class="flex-none">
                <InertiaLink :href="route('community')" class="btn btn-sm">Browse Community</InertiaLink>
            </div>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="">
    
</style>