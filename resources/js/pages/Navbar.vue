<template>
    <div
        class="flex bg-gray-100 justify-between h-16 w-full p-6 shadow-light-200 gap-4 items-center"
    >
        <div class="flex gap-4">
            <a class="text-slate-700" href="localhost">Home</a>
            <a class="text-slate-700" href="localhost/admin">Administration</a>
        </div>

        <a
            v-if="editable"
            class="text-slate-700"
            :href="`localhost/estate/${estateId}/edit`"
        >
            Editer
        </a>
        <a v-if="editable" class="text-slate-700" :href="`/login`"> Login </a>
    </div>
</template>

<script lang="ts" setup>
defineProps<{
    editable?: boolean;
    estateId?: number;
}>();
</script>
