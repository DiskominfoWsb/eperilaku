<script setup>
import Backend from '@/Layouts/BackendLayout.vue'

defineProps({
  master: { type: Object, default: null }
})
</script>

<template>
  <Backend>
    <div class="w-full border border-gray-200 rounded shadow p-5">
      <div class="w-full bg-white rounded">
        <div class="font-bold text-sm text-gray-500">Data Pengguna</div>
        <div class="text-xs text-gray-500">Halaman Data Pengguna.</div>
        <div class="mt-3 border-b mb-4" />
        <div class="w-full flex items-center justify-end">Data Pengguna</div>
      </div>
    </div>
  </Backend>
</template>

<style scoped></style>
