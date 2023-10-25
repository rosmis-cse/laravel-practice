<template>
    <div>
        <Navbar />

        <div
            class="w-screen h-screen flex items-center flex-col justify-center"
        >
            <form
                @submit.prevent="submit"
                class="p-40 flex items-center bg-gray-100 flex-col gap-4 justify-center"
            >
                <h1 class="text-left text-lg w-full">Se connecter</h1>
                <p v-if="Object.keys(errors).length" class="text-red-500">
                    {{ errors }}
                </p>

                <input
                    type="email"
                    v-model="formData.email"
                    required
                    placeholder="Votre email monsieur"
                    class="border-black p-2 rounded-md border"
                />
                <input
                    type="password"
                    v-model="formData.password"
                    placeholder="Votre mdp monsieur"
                    required
                    class="border-black p-2 rounded-md border"
                />

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { router } from "@inertiajs/vue3";
import Navbar from "./Navbar.vue";
import { ref } from "vue";

defineProps<{
    errors?: string;
}>();

const formData = ref({
    email: null,
    password: null,
});

const errorMessage = ref("");

function submit() {
    router.post("/api/authenticate", formData.value);
}
</script>
