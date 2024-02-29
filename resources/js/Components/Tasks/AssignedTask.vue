<script setup>
import { ref, defineProps, computed } from 'vue';
import { Head, Link,router } from '@inertiajs/vue3';
import moment from 'moment';
import { EyeIcon, TrashIcon } from 'vue-tabler-icons';
import TaskDelete from '@/Components/Tasks/TaskDelete.vue';
import TaskShow from '@/Components/Tasks/TaskShow.vue';

const props = defineProps({
    task: Object
});

const newProgress = ref({
    status: '',
});

const getFormattedDate = (date) => {
    return moment(date).format("MMM Do YYYY");
};

function updateProgress() {
    console.log('Updating Progress');
    console.log(newProgress.value)
    const updatedProgress = newProgress.value;
    axios.post(route('task.update.progress', {task: props.task.id}), updatedProgress)
    .then(response => {
        console.log('response:', response);
        if (response.data.Status == 'Success') {
            router.reload();
        } else {
            router.reload();
        }
    })
    .catch(error => {
        console.error('error:', error);
    })

}


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
                &nbsp;
                <v-chip
                    variant="tonal"
                >
                    {{ task.marks }} - Marks
                </v-chip>
            </v-card-title>
            <v-card-item>
                <v-card-title class="text-h4">
                    {{ task.title }}
                </v-card-title>
                <v-chip 
                    variant="outlined"
                    class="mb-2"
                >
                    Assigned by: {{ task.owner_name === $page.props.auth.user.name ? 'You' : (task.owner_name ? task.owner_name : '-')}}
                </v-chip>
                <v-chip>
                    Date - {{ getFormattedDate(task.created_at) }} 
                </v-chip>
            </v-card-item>
            <v-divider></v-divider>
            <v-card-actions class="mx-2">
                <v-dialog max-width="500">
                    <template v-slot:activator="{ props: activatorProps }">
                        <v-btn
                        v-bind="activatorProps"
                        color="surface-variant"
                        text="View Task"
                        variant="flat"
                        ></v-btn>
                    </template>

                    <template v-slot:default="{ isActive }">
                        <v-card  class="pa-4">
                            <v-text-field
                                label="Task Name"
                                v-model="task.title"
                                readonly
                            ></v-text-field>
                            <v-textarea
                                label="Task Description"
                                v-model="task.description"
                                readonly
                            ></v-textarea>
                            <v-text-field
                                label="Marks"
                                v-model="task.marks"
                                readonly
                            ></v-text-field>
                            <v-divider></v-divider>
                            
                            <v-select
                                label="Update Progress *"
                                :items="['Pending','InProgress','Completed']"
                                v-model="newProgress.status"
                            ></v-select>

                        <v-card-actions>
                            <v-btn
                            @click=" () => { updateProgress(); isActive.value = false}"
                            variant="elevated"
                            color="success"
                            >
                                Update Progress
                            </v-btn>
                            <v-spacer></v-spacer>

                            <v-btn
                            text="Close"
                            @click="isActive.value = false"
                            ></v-btn>
                        </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>
            </v-card-actions>
        </v-card>
</template>