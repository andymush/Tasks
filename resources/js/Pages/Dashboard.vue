<script setup>
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { defineProps } from 'vue';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';
import TaskCard from '@/Components/Tasks/TaskCard.vue';
import AssignedTask from '@/Components/Tasks/AssignedTask.vue';


const props = defineProps([
    'tasks',
    'task_count',
    'users',
    'assignedTasks',
]);


const getFormattedDate = (date) => {
    return moment(date).format("MMM Do YYYY");
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items center justify-center">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">My Tasks</h3>
                        </div>
                        <div class="flex items center justify-center">
                            <TaskCreation :users="users" />
                        </div>

                        <v-container fluid>
                            <p v-if="props.tasks && props.tasks.length === 0" class="text-center">
                                Start creating and assigning tasks
                            </p>
                            <v-row>
                                <v-col cols="4" lg="3" v-for="task in tasks" :key="task.id">
                                    <TaskCard  :task="task"/>
                                </v-col>
                            </v-row>
                        </v-container>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                    <div class="p-6 text-gray-900">
                        <div class="flex items center justify-center">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">Assigned Tasks</h3>
                        </div>
                        <v-container fluid>
                            <p v-if="props.assignedTasks && props.assignedTasks.length === 0" class="text-center">
                                You have no assigned tasks
                            </p>
                            <v-row>
                                <v-col cols="4" lg="3" v-for="assigned_task in assignedTasks" :key="assigned_task.id">
                                    <AssignedTask  :task="assigned_task"/>
                                </v-col>
                            </v-row>
                        </v-container>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
