<script setup>
import { ref, defineProps } from 'vue';
import {Link, router, useForm,} from "@inertiajs/vue3";
import axios from "axios";
import {CheckIcon, AlertCircleIcon, TrashFilledIcon, TrashIcon} from "vue-tabler-icons";


const props = defineProps({
    taskId: Number
})

const taskDeletedAlertDialog = ref(false);
const taskFailedAlertDialog = ref(false);

function deleteTask (taskId){
    console.log('delete in progress');
    axios.delete(route('task.destroy', {task: taskId}))
    .then(response => {
        console.log('response:', response);
        if (response.data.Status == 'Success') {
            taskDeletedAlertDialog.value = true;
            setTimeout(() => {
                taskDeletedAlertDialog.value = false;
            }, 1500);
            window.location.href = route('tasks.index');
        } else {
            taskDeleteFailedAlertDialog.value = true;
            setTimeout(() => {
                taskDeleteFailedAlertDialog.value = false;
            }, 2000);
            router.reload();
        }
    })
    .catch(error => {
        console.error('error:', error);
    });
}


</script>

<template>
          <v-dialog
            transition="dialog-bottom-transition"
            width="auto"
            min-width="500px"
            max-width="650px"
          >
            <template v-slot:activator="{ props: activatorProps }">
              <v-btn color="error"
              v-bind="activatorProps"
              width="50%" 
              variant="tonal"
              :prepend-icon="TrashIcon"
              >Delete </v-btn>
            </template>
  
            <template v-slot:default="{ isActive }">
              <v-card>
                <v-card-item>
                    <h4 class="text-h4">Delete Task permanently</h4>
                    <div class="d-sm-flex justify-space-between mt-4 mb-3">
                        <div class="text-subtitle-1 text-medium-emphasis text-13 pr-5">
                            Deleting a task is irreversible and will permanently remove all associated data and resources.
                            Please ensure you have considered this action carefully, as it cannot be undone. Confirm your
                            decision to delete the task by clicking the button below. This action will erase all records,
                            files, and assets associated with the task from the system.
                        </div>
                    </div>

                </v-card-item>
                <v-card-actions class="justify-center">
                    <v-btn color="error" class="mt-sm-0 mt-3" size="large"  variant="elevated" :prepend-icon="TrashFilledIcon" @click=" () => { deleteTask(taskId); isActive.value = false; }">Delete</v-btn>
                    <v-spacer></v-spacer>
                  <v-btn
                    text="Close"
                    variant="outlined"
                    @click="isActive.value = false"
                  ></v-btn>
                </v-card-actions>
              </v-card>
            </template>
          </v-dialog>

          <v-dialog v-model="taskDeletedAlertDialog" width="auto">
            <v-card color="success">
                <v-card-text class="text-center">
                    <v-icon class="text-center" size="79" >
                        <CheckIcon size="79" class="text-center"/>
                    </v-icon>
                    <div class="pa-6">Task Deleted Successfully </div>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog v-model="taskFailedAlertDialog" width="auto">
            <v-card color="error">
                <v-card-text class="text-center">
                    <v-icon class="text-center" size="79" >
                        <AlertCircleIcon size="79" class="text-center"/>
                    </v-icon>
                    
                    <div class="pa-6"> Failed </div>
                </v-card-text>
            </v-card>
        </v-dialog>
        
  </template>