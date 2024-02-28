<script setup>
import { ref, defineProps, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';
import TaskShow from '@/Components/Tasks/TaskShow.vue';

const props = defineProps({
    task: Object
});

const getFormattedDate = (date) => {
    return moment(date).format("MMM Do YYYY");
};



// const chipVariant = computed(() => {
//   switch (task.status) {
//     case 'Pending':
//       return { variant: 'outlined', color: 'warning' };
//     case 'InProgress':
//       return { variant: 'outlined', color: 'info' };
//     case 'Completed':
//       return { variant: 'outlined', color: 'success' };
//     default:
//       return { variant: 'outlined', color: '' }; 
//   }
// });


</script>

<template>
    <v-card
        class="mx-auto my-4"
        max-width="344"
        elevation="16"
        >
            <v-card-title>
                <v-chip
                    variant="outlined"
                >
                    {{ task.status }}
                </v-chip>
            </v-card-title>
            <v-card-item>
                <v-card-title class="text-h4">
                    {{ task.title }}
                </v-card-title>
                <v-card-subtitle>
                    {{ task.description }}
                </v-card-subtitle>
                <v-chip>
                    {{ getFormattedDate(task.created_at) }} 
                </v-chip>
            </v-card-item>
            <v-divider></v-divider>
            <v-card-actions class="mx-2">
                <TaskShow :task="task"/>
                <v-spacer></v-spacer>
                <TaskDelete :taskId="task.id"/>
            </v-card-actions>
        </v-card>
</template>