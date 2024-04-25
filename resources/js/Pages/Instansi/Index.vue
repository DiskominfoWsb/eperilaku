<script setup>
import Backend from '@/Layouts/BackendLayout.vue'
import Permission from '@/Components/Permission.vue'
import Button from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3';

defineProps({
  master: { type: Object, default: null }
})
</script>

<template>
  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">Data Instansi</div>
        <div class="text-xs text-gray-500">Halaman Data Instansi.</div>
        <div class="mt-3 mb-4 border-b" />
        <div class="flex justify-end mb-4">
          <Permission can="create_instansis">
            <Button>
              TAMBAH
            </Button>
          </Permission>
        </div>
        <div class="flex items-center justify-end w-full">
          <div class="w-full overflow-auto">
            <table class="table w-full text-sm">
              <thead class="bg-blue-400 text-slate-100">
                <tr>
                  <th class="w-0">No</th>
                  <th>Nama</th>
                  <th>Total</th>
                  <th class="w-0">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td class="w-0 whitespace-nowrap">BKD | Badan Kepegawaian Daerah</td>
                  <td class="text-center">50</td>
                  <td class="text-center">
                    <Button>E</Button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </Backend>
</template>

<style scoped></style>
