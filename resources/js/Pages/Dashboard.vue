<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/BackendLayout.vue'
import ChartRatingSkp from './Partial/ChartRatingSkp.vue'
import ChartStatusSkp from './Partial/ChartStatusSkp.vue'
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <div class="flex py-4 mx-auto">
      <div class="flex justify-center w-full px-6 space-x-2">
        <div class="w-1/3">
          <ChartRatingSkp />
        </div>
        <div class="w-1/3">
          <ChartStatusSkp />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
