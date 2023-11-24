<script lang="ts" setup>
import Navbar from "./Navbar.vue";
import { ref, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps<{
    roles: any;
    users: any[];
}>();

const initialUsers = ref(props.users);

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

    router.patch(`/api/admin/roles/${userId}`, { roles: selectedUserRoles });
}
</script>

<template>
    <div class="flex flex-col gap-8 bg-bg-green-600 items-start">
        <Navbar />

        <!-- <pre>
            {{ selectedRolesByUser[1].user }}
        </pre> -->

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
                            </td>
                            <td class="border-r p-2 border-black">
                                <button @click="saveUserRoles(user.id)">
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
        </div>
    </div>
</template>
