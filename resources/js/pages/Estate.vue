<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar editable :estate-id="estate.id" />

        <div class="max-w-lg flex gap-2 mx-auto flex-wrap">
            <h2>{{ estate.title }}</h2>
            <h3>Prix: {{ estate.price }} €</h3>
            <p>Nombre de chambres: {{ estate.rooms }}</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";

defineProps<{
    estate: {
        title: string;
        rooms: number;
        surface: number;
        price: number;
    };
}>();
</script>
