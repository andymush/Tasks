<script setup>
import { ref, defineProps } from 'vue';
import {Link, router, useForm,} from "@inertiajs/vue3";
import axios from "axios";
import {CheckIcon, AlertCircleIcon} from "vue-tabler-icons";
const task = ref({
    title: '',
    description: '',
    User_id: ''
});

const props = defineProps({
    users: Array
})


const taskCreatedAlertDialog = ref(false);
const taskFailedAlertDialog = ref(false);

const submit = () => {
    console.log(task.value);
    axios.post(route('tasks.store'), task.value)
    .then(response => {
        if (response.data.Status == 'Success') {
            taskCreatedAlertDialog.value = true;
            setTimeout(() => {
                taskCreatedAlertDialog.value = true;
            }, 1500);
            router.reload();
        } else {
            taskFailedAlertDialog.value = true;
            setTimeout(() => {
                taskFailedAlertDialog.value = false;
            }, 1500);
        }
        router.reload();
    })
    .catch(error => {
        console.log(error);
    });
}



</script>

<template>
          <v-dialog
            transition="dialog-bottom-transition"
            width="auto"
            min-width="500px"
          >
            <template v-slot:activator="{ props: activatorProps }">
              <v-btn color="primary"
              v-bind="activatorProps"
              >Create Task</v-btn>
            </template>
  
            <template v-slot:default="{ isActive }">
              <v-card>
                <v-toolbar title="Create Task"></v-toolbar>
  
                <form class="pa-5">
                    <v-text-field
                        v-model="task.title"
                        label="Task Name *"
                        required
                    ></v-text-field>
                    <v-textarea
                        v-model="task.description"
                        label="Task Description *"
                        required
                    ></v-textarea>
                    
                    <v-radio-group v-model="task.User_id">
                        <v-label class="">Assign to User (Optional)</v-label>
                        <v-radio
                            v-for="user in props.users"
                            :key="user.id"
                            :label="user.name"
                            :value="user.id"
                        ></v-radio>
                    </v-radio-group>
                    
                </form>

                <v-card-actions class="justify-end">
                    <v-btn
                    variant="elevated"
                    color="success"
                    text="Create"
                    @click=" () => { submit(); isActive.value = false; }"
                    ></v-btn>
                    <v-spacer></v-spacer>
                  <v-btn
                    text="Close"
                    @click="isActive.value = false"
                  ></v-btn>
                </v-card-actions>
              </v-card>
            </template>
          </v-dialog>

          <v-dialog v-model="taskCreatedAlertDialog" width="auto">
            <v-card color="success">
                <v-card-text class="text-center">
                    <v-icon class="text-center" size="79" >
                        <CheckIcon size="79" class="text-center"/>
                    </v-icon>
                    <div class="pa-6">Task Created Successfully </div>
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