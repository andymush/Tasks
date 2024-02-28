<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';
import moment from 'moment';


const props = defineProps({
    tasks: Array,
    users: Array
});

console.log(props.tasks)

const getFormattedDate = (date) => {
    return moment(date).format("MMM Do YYYY");
};

</script>

<template>
    <Head title="Tasks List" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items center justify-center">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-3">Tasks</h3>
                        </div>
                        <div class="flex items center justify-center">
                            <TaskCreation :users="users" />
                        </div>
                        <v-divider :thickness="5" class="mt-3" color="primary" ></v-divider>
                        <v-container fluid>
                            <v-row>
                                <v-col cols="4" lg="3" v-for="task in tasks" :key="task.id">
                                    <v-card
                                    class="mx-auto my-4"
                                    max-width="544"
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
                                            <v-btn color="error" variant="tonal">
                                                <TrashIcon/>
                                                Delete
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                        <p v-if="props.tasks && props.tasks.length === 0">
                            Create a task
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
