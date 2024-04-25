<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Head } from '@inertiajs/vue3';
import Backend from '@/Layouts/BackendLayout.vue'

defineProps({
  master: { type: Object, default: null }
})
</script>

<template>
  <Head title="Daftar Data Level Akses" />
  <Backend>
    <div class="w-full border border-gray-200 rounded shadow p-5">
      <div class="w-full bg-white rounded">
        <div class="font-bold text-sm text-gray-500">Data Akses Level</div>
        <div class="text-xs text-gray-500">Halaman Data Akses Level.</div>
        <div class="mt-3 border-b mb-4" />
        <div class="w-full flex items-center justify-center">
          Halaman ini sedang dalam pengembangan
        </div>
      </div>
    </div>
  </Backend>
</template>

<style scoped></style>
