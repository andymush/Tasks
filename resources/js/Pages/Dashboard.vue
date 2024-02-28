<script setup>
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { defineProps } from 'vue';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';


const props = defineProps([
    'tasks',
    'task_count',
    'users',
]);

console.log(props.tasks);
console.log(props.task_count);

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
                        <TaskCreation v-if="task_count <= 0" :users="users" />
                        <h5 class="font-semibold text-xl text-gray-800 leading-tight mb-1 text-center">Tasks</h5>
                        <v-container fluid>
                            <v-row>
                                <v-col cols="4" lg="3" v-for="task in tasks" :key="task.id">
                                    <v-card
                                    class="mx-auto my-4"
                                    max-width="344"
                                    elevation="16"
                                    
                                    >
                                        <v-card-item>
                                        <v-card-title class="">
                                            {{ task.title }}
                                        </v-card-title>
                                        <v-card-subtitle>
                                            {{ task.description }}
                                        </v-card-subtitle>
                                        </v-card-item>
                                        <v-divider></v-divider>
                                        <span class="caption text-no-wrap mx-4" color="cyan" label>{{ getFormattedDate(task.created_at) }} </span>

                                        <v-card-actions class="mx-2">
                                            <Link :href="route('tasks.show', task.id)">
                                                <v-btn color="primary" variant="tonal">
                                                    <EyeIcon /> &nbsp; View
                                                </v-btn>
                                            </Link>
                                            <v-spacer></v-spacer>
                                                <!-- <v-btn color="error" variant="tonal">
                                                    <TrashIcon/>
                                                    Delete
                                                </v-btn> -->
                                                <TaskDelete :task="task"/>

                                        </v-card-actions>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
