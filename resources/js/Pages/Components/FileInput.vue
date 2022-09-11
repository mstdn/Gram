<template>
    <div>
        <input type="file" ref="picker" accept="image/*" multiple @change="change" class="opacity-0" />
        <button @click="browse" type="button"
            class="flex flex-col w-full h-32 border-4 border-primary border-dashed hover:bg-gray-300 hover:border-secondary dark:hover:bg-gray-900">
            <div class="flex flex-col items-center justify-center pt-7">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-gray-400 dark:group-hover:text-gray-900 group-hover:text-gray-200" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="pt-1 text-sm tracking-wider text-gray-400 dark:group-hover:text-gray-900 group-hover:text-gray-300">
                    Upload images(max 10MB)
                </p>
            </div>
        </button>
    </div>
</template>
<script>
export default {
    methods: {
        browse() {
            this.$refs.picker.click();
        },
        change(e) {
            this.$emit('input', e.target.files);
        },
    }
}
</script>