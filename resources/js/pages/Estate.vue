<template>
    <div class="flex flex-col w-full gap-8 bg-bg-green-600 items-start">
        <Navbar editable :estate-id="estate.id" />

        <ErrorBanner v-if="error" :error="error" />

        <div class="w-3/4 flex flex-col items-start gap-2 flex-wrap mx-auto">
            <h2>{{ estate.title }}</h2>
            <h3>Prix: {{ estate.price }} €</h3>
            <p>Nombre de chambres: {{ estate.rooms }}</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import ErrorBanner from "./ErrorBanner.vue";

defineProps<{
    estate: {
        title: string;
        rooms: number;
        surface: number;
        price: number;
    };
    error?: string;
}>();
</script>
