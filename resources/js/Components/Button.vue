<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="btn btn-primary disabled:btn-disabled transition">
        <slot />
    </button>
</template>
