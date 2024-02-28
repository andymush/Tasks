<script setup>
import { ref, defineProps, reactive } from 'vue';
import {Link, router, useForm} from "@inertiajs/vue3";
import axios from "axios";
import {CheckIcon, AlertCircleIcon, UploadIcon } from "vue-tabler-icons";

const props = defineProps({
    task: Object
})

const title = ref(props.task.title)
const description = ref(props.task.description)
const userId = ref(props.task.user_id)

const form = reactive({
    title,
    description,
    userId,
})

const updatedTask = useForm({
    title,
    description,
    userId,
})


const taskUpdatedAlertDialog = ref(false);
const taskFailedAlertDialog = ref(false);


function updateTask ()
{
    console.log('updating the task now')
    console.log(props.task)
    axios.post(route('task.update', {task: props.task.id}), updatedTask)
    .then(response => {
        console.log('response:', response);
        if (response.data.Status == 'Success') {
            taskUpdatedAlertDialog.value = true;
            setTimeout(() => {
                taskUpdatedAlertDialog.value = false;
            }, 1500);
            router.reload();
        } else {
            taskFailedAlertDialog.value = true;
            setTimeout(() => {
                taskFailedAlertDialog.value = false;
            }, 2000);
            router.reload();
        }
        
    })
    .catch(error => {
        console.error('error:', error);
    })
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
              <v-btn 
                    color="primary" 
                    variant="tonal"
                    v-bind="activatorProps"
                >
                    <EyeIcon /> &nbsp; View it
                </v-btn>
            </template>
  
            <template v-slot:default="{ isActive }">
              <v-card>
                <v-card-item>
                    <v-text-field
                        v-model="updatedTask.title"
                        label="Task Name *"
                        required
                    ></v-text-field>
                    <v-textarea
                        v-model="updatedTask.description"
                        label="Task Description *"
                        required
                    ></v-textarea>
                    
                    <!-- <v-radio-group v-model="updatedTask.userId">
                        <v-label class="">Assign to User (Optional)</v-label>
                        <v-radio
                            v-for="user in props.users"
                            :key="user.id"
                            :label="user.name"
                            :value="user.id"
                        ></v-radio>
                    </v-radio-group> -->


                </v-card-item>
                <v-card-actions class="justify-center">
                    <v-btn color="success" class="mt-sm-0 mt-3" size="large"  variant="elevated" :prepend-icon="UploadIcon" @click=" () => { updateTask(); isActive.value = false; }">Update</v-btn>
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

          <v-dialog v-model="taskUpdatedAlertDialog" width="auto">
            <v-card color="success">
                <v-card-text class="text-center">
                    <v-icon class="text-center" size="79" >
                        <CheckIcon size="79" class="text-center"/>
                    </v-icon>
                    <div class="pa-6">Task Updated Successfully </div>
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