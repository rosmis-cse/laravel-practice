<template>
    <div
        class="flex bg-gray-100 justify-between h-16 w-full p-6 shadow-light-200 gap-4 items-center"
    >
        <div class="flex gap-4">
            <a class="text-slate-700" href="/">Home</a>
            <a class="text-slate-700" href="/admin">Administration</a>
        </div>

        <a
            v-if="editable"
            class="text-slate-700"
            :href="`/estates/${estateId}/edit`"
        >
            Editer
        </a>

        <div class="flex gap-4">
            <template v-if="isUserLoggedIn">
                <a
                    href="../estates/create"
                    class="p-2 border border-black rounded-md"
                    >Créer une offre</a
                >
                <button
                    class="p-2 border border-black rounded-md"
                    @click="logoutUser()"
                >
                    Se deconnecter
                </button>
            </template>

            <a
                v-else
                class="p-2 border border-black rounded-md"
                :href="`/login`"
            >
                Login
            </a>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";

const page = usePage();

defineProps<{
    editable?: boolean;
    estateId?: number;
}>();

const isUserLoggedIn = computed(() => page.props.user);

function logoutUser() {
    router.post("/logout");
}
</script>
