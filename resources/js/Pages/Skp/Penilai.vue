<script setup>
import { onMounted, ref } from 'vue'
import PenilaiModal from '@/Pages/Skp/PenilaiModal.vue'
import getPegawai from '@/services/getPegawai'

const penilaiModal = ref(false)
const atasan = ref({})

const props = defineProps({
  isPenilai: Boolean,
  nip: { type: String, default: '' },
  skp: { type: Object, default: null }
})

const getData = async nip => {
  if (nip != '') {
    atasan.value = await getPegawai(nip)
  }
}

const handleClose = () => {
  getData(props.nip)
  penilaiModal.value = false
}

onMounted(() => {
  getData(props.nip)
})
</script>

<template>
  <div class="overflow-x-auto print:overflow-x-hidden">
    <table class="min-w-full mt-4 text-xs">
      <tr>
        <td class="px-0 whitespace-no-wrap border-none" colspan="3">
          PERIODE
          <div class="hidden md:contents">PENILAIAN</div>
          : {{ skp.mulai.toUpperCase() }} <span class="md:hidden">s.d.</span>
          <div class="hidden md:contents">SAMPAI DENGAN</div>
          {{ skp.selesai.toUpperCase() }} TAHUN {{ skp.tahun }}
        </td>
      </tr>
      <tr>
        <td class="w-[50px] whitespace-nowrap">NO</td>
        <td colspan="2" class="whitespace-nowrap">
          <div class="flex items-center justify-between w-full">
            PEJABAT PENILAI KINERJA
            <button
              v-if="!isPenilai"
              class="px-3 text-xs font-semibold text-white bg-green-500 rounded-sm print:hidden"
              @click="penilaiModal = true"
            >
              PILIH
            </button>
          </div>
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td class="w-[50px] whitespace-nowrap">NAMA</td>
        <td>{{ atasan.nama }}</td>
      </tr>
      <tr>
        <td>2</td>
        <td>NIP</td>
        <td>{{ atasan.nip }}</td>
      </tr>
      <tr>
        <td>3</td>
        <td>PANGKAT/GOL</td>
        <td>{{ atasan.pangakat_golongan }}</td>
      </tr>
      <tr>
        <td>4</td>
        <td>JABATAN</td>
        <td>{{ atasan.jabatan }}</td>
      </tr>
      <tr>
        <td>5</td>
        <td>UNIT KERJA</td>
        <td>{{ atasan.unit_kerja }}</td>
      </tr>
    </table>
    <PenilaiModal
      :show="penilaiModal"
      :skp-id="skp.id"
      @close="handleClose"
      @atasan="getData"
    />
  </div>
</template>

<style scoped></style>
