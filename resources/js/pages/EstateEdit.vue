<template>
    <div class="flex flex-col w-full gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <div class="w-3/4 flex flex-col items-start gap-2 flex-wrap mx-auto">
            <form
                @submit.prevent="saveEstate"
                class="p-40 flex items-center bg-gray-100 flex-col gap-4 justify-center"
            >
                <input
                    type="text"
                    v-model="formData.title"
                    required
                    placeholder="Titre"
                    class="border-black p-2 rounded-md border"
                />
                <input
                    type="number"
                    v-model="formData.price"
                    required
                    placeholder="Prix"
                    class="border-black p-2 rounded-md border"
                />
                <input
                    type="number"
                    v-model="formData.rooms"
                    required
                    placeholder="Nb de chambres"
                    class="border-black p-2 rounded-md border"
                />

                <button type="submit">Sauvegarder</button>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps<{
    estate: {
        id: number;
        title: string;
        rooms: number;
        surface: number;
        price: number;
    };
}>();

const { price, title, surface, rooms } = props.estate;

const formData = ref({
    price,
    title,
    surface,
    rooms,
});

function saveEstate() {
    router.patch(`/api/estates/${props.estate.id}`, formData.value);
}
</script>
