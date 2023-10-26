<template>
    <a
        :href="`/estates/${estate.id}`"
        class="flex flex-col gap-2 items-center p-4 rounded-sm bg-slate-100 min-h-20 hover:shadow-lg transition"
    >
        <h2>{{ estate.title }}</h2>
        <h3>Prix: {{ estate.price }} €</h3>
        <p>Nombre de chambres: {{ estate.rooms }}</p>
    </a>
</template>

<script lang="ts" setup>
defineProps<{
    estate: {
        id: number;
        title: string;
        rooms: number;
        surface: number;
        price: number;
    };
}>();
</script>
