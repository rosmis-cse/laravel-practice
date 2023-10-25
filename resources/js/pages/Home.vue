<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <div v-if="estates" class="max-w-md flex gap-2 mx-auto flex-wrap">
            <EstateCard
                v-for="(estate, index) in estates"
                :estate="estate"
                :key="index"
            />
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import EstateCard from "./EstateCard.vue";

defineProps<{
    estates: {
        title: string;
        rooms: number;
        surface: number;
        price: number;
    };
}>();
</script>
