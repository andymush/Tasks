<script setup>
import { ref, defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';

const props = defineProps({
    task: Object
});

const getFormattedDate = (date) => {
    return moment(date).format("MMM Do YYYY");
};


</script>

<template>
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
                    <TaskDelete :taskId="task.id"/>
                    {{ task.id }}

            </v-card-actions>
        </v-card>
</template>