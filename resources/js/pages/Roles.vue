<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { ref, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    users: any[];
    currentUser: any;
}>();

const selectedRolesByUser = ref(
    props.users.reduce((acc, currentValue) => {
        const currentUserRole: string[] = currentValue.roles.map(
            (role) => role.role
        );

        if (!acc[currentValue.id]) {
            acc = {
                ...acc,
                [currentValue.id]: {
                    user: currentUserRole.includes("user"),
                    admin: currentUserRole.includes("admin"),
                },
            };
        }

        return acc;
    }, {})
);

function saveUserRoles(userId: number) {
    const selectedUserRoles = Object.keys(
        selectedRolesByUser.value[userId]
    ).filter((role) => selectedRolesByUser.value[userId][role]);

    return router.patch(`/api/admin/roles/${userId}`, {
        roles: selectedUserRoles,
    });
}
</script>

<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

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
                                <input
                                    v-model="selectedRolesByUser[user.id].user"
                                    type="checkbox"
                                    disabled
                                />
                            </td>
                            <td class="border-r p-2 border-black">
                                <input
                                    v-model="selectedRolesByUser[user.id].admin"
                                    type="checkbox"
                                />
                                <!-- <input
                                    v-model="selectedRolesByUser[user.id].admin"
                                    type="checkbox"
                                    :disabled="user.id === currentUser.id"
                                /> -->
                            </td>
                            <td class="border-r p-2 border-black">
                                <button @click="saveUserRoles(user.id)">
                                    Sauvegarder
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
