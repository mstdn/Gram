<template>
    <div>
        <footer class="footer footer-center p-10 bg-white text-gray-900 dark:text-white dark:bg-gray-900 rounded">
            <div class="grid grid-flow-col gap-4">
                <InertiaLink href="/" class="link link-hover">About</InertiaLink>
                <InertiaLink href="/terms-of-service" class="link link-hover">Terms</InertiaLink>
                <InertiaLink href="/privacy-policy" class="link link-hover">Privacy</InertiaLink>
                <a href="https://github.com/mstdn/Gram" target="_blank" class="link link-hover">Source</a>
            </div>
            <div>
                <div class="grid grid-flow-col gap-4">
                    <a href="https://mstdn.social/@stux" target="_blank" alt="Mastodon" class="hover:bg-gray-300 dark:hover:bg-gray-800 p-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-mastodon" viewBox="0 0 16 16">
                            <path
                                d="M11.19 12.195c2.016-.24 3.77-1.475 3.99-2.603.348-1.778.32-4.339.32-4.339 0-3.47-2.286-4.488-2.286-4.488C12.062.238 10.083.017 8.027 0h-.05C5.92.017 3.942.238 2.79.765c0 0-2.285 1.017-2.285 4.488l-.002.662c-.004.64-.007 1.35.011 2.091.083 3.394.626 6.74 3.78 7.57 1.454.383 2.703.463 3.709.408 1.823-.1 2.847-.647 2.847-.647l-.06-1.317s-1.303.41-2.767.36c-1.45-.05-2.98-.156-3.215-1.928a3.614 3.614 0 0 1-.033-.496s1.424.346 3.228.428c1.103.05 2.137-.064 3.188-.189zm1.613-2.47H11.13v-4.08c0-.859-.364-1.295-1.091-1.295-.804 0-1.207.517-1.207 1.541v2.233H7.168V5.89c0-1.024-.403-1.541-1.207-1.541-.727 0-1.091.436-1.091 1.296v4.079H3.197V5.522c0-.859.22-1.541.66-2.046.456-.505 1.052-.764 1.793-.764.856 0 1.504.328 1.933.983L8 4.39l.417-.695c.429-.655 1.077-.983 1.934-.983.74 0 1.336.259 1.791.764.442.505.661 1.187.661 2.046v4.203z" />
                        </svg>
                    </a>
                    <a href="https://github.com/mstdn/Gram" target="_blank" alt="Source code on Github" class="hover:bg-gray-300 dark:hover:bg-gray-800 p-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-github" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                        </svg>
                    </a>
                    <DonationModal />
                </div>
            </div>
            <div>
                <p>© 2022. - <a href="https://gram.social" class="hover:underline" target="_blank">Gram</a></p>
            </div>
        </footer>
    </div>
</template>
<script setup>
import DonationModal from "./DonationModal.vue";

</script>
