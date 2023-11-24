<template>
    <div class="flex flex-col w-full gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <div class="w-3/4 flex flex-col items-start gap-2 flex-wrap mx-auto">
            <form
                @submit.prevent="createEstate"
                class="p-40 flex items-center bg-gray-100 flex-col gap-4 justify-center"
            >
                <h1>Créer un bien immobilier</h1>

                <input
                    type="text"
                    v-model="formData.title"
                    required
                    placeholder="Titre de l'option"
                    class="border-black p-2 rounded-md border"
                />

                <button type="submit">Créer</button>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps<{
    user: any;
}>();

const formData = ref({
    price: null,
    title: null,
    surface: null,
    rooms: null,
    options: null,
    user_id: props.user.id,
});

function createEstate() {
    router.post(`/api/estates`, formData.value);
}
</script>
