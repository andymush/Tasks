<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';

const props = defineProps({
    tasks: Array,
    users: Array
})

</script>

<template>
    <Head title="Tasks List" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
                            <TaskCreation :users="users" />
                        </div>
                        <v-divider :thickness="5" class="mt-3" color="primary" ></v-divider>
                        <div>
                            {{ props.tasks }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
