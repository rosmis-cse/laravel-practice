<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { ref, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    roles: any;
    users: any[];
}>();

const selectedUserId = ref<number>(undefined);

function saveUserRole(index: number) {}

const usersCopy = ref(props.users);

const selectedRolesByUser = computed(() => {
    return props.users.reduce((acc, currentValue) => {
        const currentUserRole: string[] = currentValue.roles.map(
            (role) => role.role
        );

        acc = {
            ...acc,
            [currentValue.id]: {
                user: currentUserRole.includes("user"),
                admin: currentUserRole.includes("admin"),
            },
        };
        console.log(currentValue.id);

        return acc;
    });
});

console.log(selectedRolesByUser.value);
</script>

<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <pre>
            {{ selectedRolesByUser }}
        </pre>

        <div class="h-full w-full gap-4 flex items-center justify-start">
            <div class="flex items-center justify-center w-full h-full ml-14">
                <table>
                    <thead class="border-b border-black">
                        <td class="border-r p-2 border-black">Utilisateur</td>
                        <td class="border-r p-2 border-black">
                            Is user user ?
                        </td>
                        <td class="border-r p-2 border-black">
                            Is user admin ?
                        </td>
                        <td class="border-r p-2 border-black">Sauvegarde</td>
                    </thead>

                    <tbody>
                        <tr
                            v-for="(user, index) in users"
                            :key="`user-${index}`"
                        >
                            <td class="border-r p-2 border-black">
                                {{ user.name }}
                            </td>

                            <td class="border-r p-2 border-black">
                                <input type="checkbox" />
                            </td>
                            <td class="border-r p-2 border-black">
                                <input type="checkbox" />
                            </td>
                            <td class="border-r p-2 border-black">
                                <button @click="saveUserRole(user.id)">
                                    Sauvegarder
                                </button>
                            </td>

                            <!-- <template
                                v-for="(role, index) in user.roles"
                                :key="`role-${index}`"
                            >
                                <td>{{ role.role }}</td>
                            </template> -->
                        </tr>
                    </tbody>
                </table>

                <!-- <div
                    class="border-t border-black w-full flex flex-col items-start mt-4"
                >
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
                </div> -->
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
