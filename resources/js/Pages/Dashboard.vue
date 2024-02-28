<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <v-btn color="primary">Create Task</v-btn>
                        <v-radio-group>
  <v-radio label="Radio One" value="one"></v-radio>
  <v-radio label="Radio Two" value="two"></v-radio>
  <v-radio label="Radio Three" value="three"></v-radio>
</v-radio-group>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
