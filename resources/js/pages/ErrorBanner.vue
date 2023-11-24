<template>
    <p class="p-4 bg-red-500 text-white w-full text-center">{{ error }}</p>
</template>

<script lang="ts" setup>
defineProps<{
    error?: string;
}>();
</script>
