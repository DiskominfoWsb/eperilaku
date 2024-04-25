<script setup>
import { Link } from '@inertiajs/vue3';
import Backend from '@/Layouts/BackendLayout.vue'

defineProps({
  pegawai: { type: Object, default: null }
})
</script>

<template>
  <Backend>
    <div class="w-full p-3 border border-gray-200 rounded shadow md:p-5">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">Data Pegawai</div>
        <div class="text-xs text-gray-500">Halaman Data Pegawai.</div>
        <div class="mt-3 mb-4 border-b" />
        <div class="flex justify-start">
          <Link class="btn-warning" :href="route('pegawai.index')">
            Kembali
          </Link>
        </div>
        <div class="w-full mt-5 text-sm select-none">
          <div
            class="w-full bg-blue-400 uppercase text-white font-semibold py-1.5 px-3 text-center md:text-left"
          >
            Informasi Data Pegawai
          </div>
          <div class="flex justify-center mt-4 md:hidden">
            <img
              class="w-24 h-32 border rounded"
              :src="`/upload/profile/${pegawai.user.photo}`"
              :alt="pegawai.nama"
            />
          </div>
          <table class="w-full mt-4">
            <tr class="hidden md:table-row">
              <td class="w-32 whitespace-no-wrap align-top" rowspan="8">
                <img
                  class="w-24 h-32 border rounded"
                  :src="`/upload/profile/${pegawai.user.photo}`"
                  :alt="pegawai.nama"
                />
              </td>
              <td class="w-0 whitespace-no-wrap">Nip</td>
              <td>: {{ pegawai.nip }}</td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>: {{ pegawai.nama_formatted }}</td>
            </tr>
            <tr class="hidden md:table-row">
              <td class="w-0 whitespace-nowrap">Tempat / Tanggal Lahir</td>
              <td>
                : {{ pegawai.t_lahir }}, {{ pegawai.tanggal_lahir_formatted }}
              </td>
            </tr>
            <tr class="table-row md:hidden">
              <td class="w-0 whitespace-nowrap">Tempat Lahir</td>
              <td class="whitespace-nowrap">: {{ pegawai.t_lahir }}</td>
            </tr>
            <tr class="table-row md:hidden">
              <td class="w-0 whitespace-nowrap">Tanggal Lahir</td>
              <td class="whitespace-nowrap">
                : {{ pegawai.tanggal_lahir_formatted }}
              </td>
            </tr>
            <tr>
              <td class="w-0 whitespace-nowrap">Jenis Kelamin</td>
              <td>
                : {{ pegawai.jns_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}
              </td>
            </tr>
            <tr>
              <td class="w-0 whitespace-nowrap">Pangkat/Gol</td>
              <td>: {{ pegawai.golongan.golongan_name_formatted }}</td>
            </tr>
            <tr>
              <td class="w-0 whitespace-nowrap">Jabatan</td>
              <td>: {{ pegawai.jabatan }}</td>
            </tr>
            <tr>
              <td class="w-0 whitespace-nowrap">Unit Kerja</td>
              <td>: {{ pegawai.instansi }}</td>
            </tr>
            <tr>
              <td class="w-0 whitespace-nowrap">E-Mail</td>
              <td>: {{ pegawai.user.email }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </Backend>
</template>

<style scoped>
table,
tr,
td {
  border: none;
}
</style>
