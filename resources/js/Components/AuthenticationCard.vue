<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 bg-cover bg-center" style="background-image: url(https://gram.social/images/background.jpg)">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white text-gray-900 dark:bg-gray-900 dark:text-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
