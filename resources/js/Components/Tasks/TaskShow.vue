<script setup>
import { ref, defineProps, reactive } from 'vue';
import {Link, router, useForm} from "@inertiajs/vue3";
import axios from "axios";
import {CheckIcon, AlertCircleIcon, UploadIcon } from "vue-tabler-icons";

const props = defineProps({
    task: Object,
    users: Array,
})

const title = ref(props.task.title)
const description = ref(props.task.description)
const userId = ref(props.task.user_id)
const marks = ref(props.task.marks)
const status = ref(props.task.status)

const form = reactive({
    title,
    description,
    userId: userId.value,
    marks,
})

const updatedTask = useForm({
    title,
    description,
    userId: userId.value,
    marks,
    status,
})

const taskUpdatedAlertDialog = ref(false);
const taskFailedAlertDialog = ref(false);

function updateTask ()
{
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
                    <EyeIcon /> &nbsp; View
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
                    
                    <v-radio-group v-model="updatedTask.userId" v-if="$page.props.auth.user.id === task.Owner_id">
                        <v-label class="">Assign to User (Optional)</v-label>
                        <v-radio
                            v-for="user in props.users"
                            :key="user.id"
                            :label="user.name"
                            :value="user.id"
                        ></v-radio>
                    </v-radio-group>
            
                    <v-text-field
                    v-model="updatedTask.marks"
                    label="Marks"
                    type="number"
                    />

                    <v-text-field
                    label="Status"
                    v-model="status"
                    readonly
                    />


                </v-card-item>
                <v-card-actions class="justify-center">
                    <v-btn color="success" class="mt-sm-0 mt-3" size="large"  variant="elevated" :prepend-icon="UploadIcon" @click=" () => { updateTask(); isActive.value = false; }" 
                        v-if="$page.props.auth.user.id === task.Owner_id"
                        >Update</v-btn>
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