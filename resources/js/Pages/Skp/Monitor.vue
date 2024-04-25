<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Head } from '@inertiajs/vue3';
import Backend from '@/Layouts/BackendLayout.vue'

defineProps({
  master: { type: Object, default: null }
})
</script>

<template>
  <Head title="Data Monitoring Pengisian SKP" />
  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">
          Monitoring Pengisian SKP
        </div>
        <div class="text-xs text-gray-500">
          Halaman Monitoring Pengisian SKP.
        </div>
        <div class="mt-3 mb-4 border-b" />
        <div class="flex items-center justify-end w-full">
          <div class="w-full overflow-auto">
            <table class="table w-full text-sm">
              <thead class="bg-blue-400 text-slate-100">
                <tr>
                  <th class="w-0" rowspan="2">No</th>
                  <th rowspan="2">Instansi</th>
                  <th class="w-0" rowspan="2">Tahun</th>
                  <th colspan="4" class="text-center">Statistik</th>
                  <th rowspan="2">Total</th>
                  <th class="w-0" rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th>Belum</th>
                  <th>Draf</th>
                  <th>Pengajuan</th>
                  <th>Persetujuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td class="whitespace-nowrap">Nama Instansi 1</td>
                  <td class="text-center">2022</td>
                  <td class="text-center">50</td>
                  <td class="text-center">30</td>
                  <td class="text-center">20</td>
                  <td class="text-center">1</td>
                  <td class="text-center">{{ 50 + 30 + 20 }}</td>
                  <td>
                    <button>V</button>
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
