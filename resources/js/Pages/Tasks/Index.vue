<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import TaskCreation from '@/Components/Tasks/TaskCreation.vue';
import moment from 'moment';
import TaskCard from '@/Components/Tasks/TaskCard.vue';


const props = defineProps({
    tasks: Array,
    users: Array
});

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
                                    <TaskCard :task="task"/>
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
