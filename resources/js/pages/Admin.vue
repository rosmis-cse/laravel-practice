<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <div class="h-full w-full gap-4 flex items-center justify-center">
            <a
                href="../options/create"
                class="p-2 border border-black rounded-md"
                >Ajouter une option de bien immo</a
            >
            <a href="./admin/roles" class="p-2 border border-black rounded-md"
                >Gérer les rôles</a
            >
        </div>
    </div>
</template>

<script lang="ts" setup>
import Navbar from "./Navbar.vue";
</script>
