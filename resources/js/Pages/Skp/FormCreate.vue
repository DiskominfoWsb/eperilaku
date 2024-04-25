<script setup>
import { PlusIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import Pegawai from '@/Pages/Skp/Pegawai.vue'
import Penilai from '@/Pages/Skp/Penilai.vue'
import FormModalUtama from '@/Pages/Skp/FormModalUtama.vue'

defineProps({
  skpList: { type: Object, default: null }
})
const formUtama = ref(false)
const formTambahan = ref(false)

const testclick = () => {}
</script>

<template>
  <div class="w-full p-5 border border-gray-200 rounded shadow">
    <div class="w-full bg-white rounded">
      <p class="w-full text-center">SASARAN KINERJA PEGAWAI</p>
      <p class="w-full text-center">PENDEKATAN HASIL KERJA KUANTITATIF</p>
      <p class="w-full text-center">
        BAGI PEJABAT PIMPINAN TINGGI DAN PIMPINAN UNIT KERJA MANDIRI
      </p>
      <div class="flex flex-col w-full space-x-0 md:flex-row md:space-x-2">
        <div class="w-full md:w-1/2">
          <Pegawai />
        </div>
        <div class="w-full md:w-1/2">
          <Penilai />
        </div>
      </div>
      <div
        class="w-full px-3 py-2 mt-4 text-xs font-bold text-white bg-blue-400"
      >
        HASIL KERJA
      </div>
      <table class="w-full text-xs">
        <tr
          class="font-semibold text-center text-white bg-blue-400 whitespace-nowrap"
        >
          <td>NO</td>
          <td>RENCANA HASIL KERJA ATASAN YANG DIINTERVENSI</td>
          <td>RENCANA HASIL KERJA</td>
          <td>ASPEK</td>
          <td>INDIKATOR KINERJA INDIVIDU</td>
          <td>TARGET</td>
        </tr>
        <tr
          class="font-semibold text-center text-white bg-blue-400 whitespace-nowrap"
        >
          <td>(1)</td>
          <td>(2)</td>
          <td>(3)</td>
          <td>(4)</td>
          <td>(5)</td>
          <td>(6)</td>
        </tr>
        <tr class="font-semibold text-white bg-blue-400 whitespace-nowrap">
          <td colspan="6" class="w-full whitespace-nowrap">
            <div class="flex items-center justify-between">
              A. UTAMA
              <button
                class="flex px-2 py-1 ml-2 bg-green-500"
                @click="formUtama = true"
              >
                <PlusIcon class="w-4 h-4" /> UTAMA
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="6" class="text-center">BLEMUM ADA DATA</td>
        </tr>
        <tr class="font-semibold text-white bg-blue-400 whitespace-nowrap">
          <td colspan="6" class="w-full whitespace-nowrap">
            <div class="flex items-center justify-between">
              B. TAMBAHAN
              <button
                class="flex px-2 py-1 ml-2 bg-green-500"
                @click="formTambahan = true"
              >
                <PlusIcon class="w-4 h-4" /> TAMBAHAN
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="6" class="text-center">BLEMUM ADA DATA</td>
        </tr>
      </table>
      <table class="w-full mt-4 text-xs">
        <tr class="font-semibold text-white bg-blue-400">
          <td colspan="3" class="w-full py-2 whitespace-nowrap">
            PERILAKU KERJA
          </td>
        </tr>
        <tr>
          <td class="w-0">1</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Berorientasi pelayanan
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>2</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Akuntabel
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>3</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Kompeten
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>4</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Harmonis
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>5</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Loyal
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>6</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Adaptif
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
        <tr>
          <td>7</td>
          <td
            class="hover:bg-blue-400 hover:cursor-pointer hover:text-white"
            @click="testclick()"
          >
            Kolaboratif
          </td>
          <td>Ekspektasi Khusus Pimpinan:</td>
        </tr>
      </table>
    </div>
    <FormModalUtama v-if="formUtama" @form-utama="formUtama = false" />
  </div>
</template>

<style scoped></style>
