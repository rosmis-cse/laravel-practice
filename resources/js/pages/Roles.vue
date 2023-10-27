<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    roles: any;
    users: any;
}>();

const selectedUserId = ref<number>(undefined);

function getAssociatedRoles() {
    const response = router.get(`/api/roles/${selectedUserId.value}`);

    console.log("response", response);
}
</script>

<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <div class="h-full w-full gap-4 flex items-center justify-start">
            <div
                class="flex flex-col items-start ml-14"
                :class="{
                    'w-1/2': !selectedUserId,
                    'w-full flex-1': selectedUserId,
                }"
            >
                <h1 v-if="!selectedUserId">
                    Veuillez selectionner un utilisateur pour en modifier ses
                    roles
                </h1>

                <pre v-for="(role, index) in roles" :key="index">
                    {{ role }}
                </pre>

                <div class="border-t border-black w-full mt-4">
                    <button
                        v-for="(user, index) in users"
                        :key="`user-${index}`"
                        class="underline"
                        @click="
                            selectedUserId = user.id;
                            getAssociatedRoles();
                        "
                    >
                        {{ user.name }}
                    </button>
                </div>
            </div>

            <div
                v-if="selectedUserId"
                class="flex flex-col items-start mr-14"
                :class="{
                    'w-full flex-1': selectedUserId,
                }"
            >
                <p v-if="!selectedUserId">
                    Veuillez selectionner un utilisateur pour en modifier ses
                    roles
                </p>

                <div class="border-t border-black w-full mt-4">
                    <button
                        v-for="(user, index) in users"
                        :key="`user-${index}`"
                    >
                        {{ user.name }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
