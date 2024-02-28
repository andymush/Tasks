<script setup>
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { defineProps } from 'vue';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';
import TaskCard from '@/Components/Tasks/TaskCard.vue';


const props = defineProps([
    'tasks',
    'task_count',
    'users',
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
                        <TaskCreation v-if="task_count <= 0" :users="users" />
                        <h5 class="font-semibold text-xl text-gray-800 leading-tight mb-1 text-center">Tasks</h5>
                        <v-container fluid>
                            <v-row>
                                <v-col cols="4" lg="3" v-for="task in tasks" :key="task.id">
                                    <TaskCard  :task="task"/>
                                </v-col>
                            </v-row>
                        </v-container>
                    
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
