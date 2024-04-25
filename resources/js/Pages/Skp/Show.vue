<script setup>
/* eslint no-unused-vars: "off" */
import { Link, Head, useForm } from '@inertiajs/vue3';
import { PlusIcon, TrashIcon, PencilIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import Backend from '@/Layouts/BackendLayout.vue'
import Pegawai from '@/Pages/Skp/Pegawai.vue'
import Penilai from '@/Pages/Skp/Penilai.vue'
import FormModalUtama from '@/Pages/Skp/FormModalUtama.vue'
import DialogModal from '@/Components/DialogModal.vue'
import FormEditModalUtama from '@/Pages/Skp/FormEditModalUtama.vue'
import SkpPerilaku from './SkpPerilaku.vue'
import axios from 'axios'
import toastr from 'toastr'

const formUtama = ref(false)
const jenisKinerja = ref(null)
const formEditKinerja = ref(false)
const kinerjaData = ref({})
const modalDeleteKinerja = ref(false)

const props = defineProps({
  skp: { type: Object, default: null },
  isPenilai: Boolean
})

const openModalKinerja = jenis => {
  jenisKinerja.value = jenis
  formUtama.value = true
}

const formHapus = useForm({
  kinerja: ''
})

const dialogHapusKinerja = kinerjaId => {
  modalDeleteKinerja.value = true
  formHapus.kinerja = kinerjaId
}

const closeModalHapusKinerja = () => {
  formHapus.reset()
  modalDeleteKinerja.value = false
}

const closeSuccess = () => {
  toastr.success('Berhasil di hapus', 'success')
  closeModalHapusKinerja()
}

const rating = ref(null)
const rating_status = ref('-')

const changeRating = (event) => {
  const status = event.target.value
  switch(status) {
    case 'atas' :
    case 'sesuai' :
      rating_status.value = 'baik'
      break;
    case 'bawah' :
      rating_status.value = 'kurang'
      break;
    default:
      rating_status.value = '-'
  }
  kirimUpdateSkpRating(props.skp?.id, status)
}

const kirimUpdateSkpRating = (id,rating) => {
  axios.post(route('update.skp.rating'), {
    skp : id, rating_status : rating
  }).then(resp => {
    toastr.info('berhasil merubah status rating skp')
  }).catch(err => {
    console.log(err)
  })
}

const kirimHapusKinerja = () => {
  formHapus.delete(route('kinerja.destroy', formHapus.kinerja), {
    preserveScroll: true,
    preserveState: true,
    onError: errs => {},
    onSuccess: () => {
      closeSuccess()
    }
  })
}

const updateDataKinerja = kinerja => {
  kinerjaData.value = kinerja
  formEditKinerja.value = true
}
</script>

<template>
  <div>
    <Head title="Lihat SKP" />
    <Backend>
      <div
        class="w-full px-6 py-3 border border-gray-200 rounded shadow print:border-none print:shadow-none"
      >
        <div class="w-full bg-white rounded">
          <p class="w-full text-center">SASARAN KINERJA PEGAWAI</p>
          <p class="w-full text-center">PENDEKATAN HASIL KERJA KUANTITATIF</p>
          <p class="w-full text-center">
            BAGI PEJABAT PIMPINAN TINGGI DAN PIMPINAN UNIT KERJA MANDIRI
          </p>
          <div
            class="flex flex-col w-full space-x-0 md:flex-row print:flex-row md:space-x-2 print:space-x-2 print:mr-24"
          >
            <div class="w-full md:w-1/2 print:w-1/2">
              <Pegawai :pegawai="skp?.pegawai" />
            </div>
            <div class="w-full md:w-1/2 print:w-1/2">
              <Penilai
                :nip="skp.atasan?.nip"
                :skp="skp"
                :is-penilai="isPenilai"
              />
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="table w-full mt-4 text-xs">
              <tr
                class="font-semibold text-center text-white bg-blue-400 whitespace-nowrap"
              >
                <td colspan="6" class="py-2 text-left">HASIL KERJA</td>
              </tr>
              <tr
                class="font-semibold text-center text-white bg-blue-400 whitespace-nowrap"
              >
                <td>NO</td>
                <td>RENCANA HASIL KERJA ATASAN<br />YANG DIINTERVENSI</td>
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
              <tr
                class="font-semibold text-white bg-blue-400 whitespace-nowrap"
              >
                <td colspan="6" class="w-full whitespace-nowrap">
                  <div class="flex items-center justify-between">
                    A. UTAMA
                    <button
                      v-if="!isPenilai"
                      class="flex px-2 py-1 ml-2 bg-green-500 print:hidden"
                      @click="openModalKinerja('UTAMA')"
                    >
                      <PlusIcon class="w-4 h-4" /> UTAMA
                    </button>
                  </div>
                </td>
              </tr>
              <template v-if="skp.utama_count > 0">
                <tr v-for="(item, index) in skp.utama" :key="item.id">
                  <td class="w-0 align-top whitespace-nowrap">
                    <div class="flex items-center">
                      <p>{{ index + 1 }}</p>
                      <button
                        v-if="!isPenilai"
                        class="p-2 ml-3 border print:hidden"
                        @click="updateDataKinerja(item)"
                      >
                        <PencilIcon class="w-4 h-4 text-blue-400" />
                      </button>
                      <button
                        v-if="!isPenilai"
                        class="p-2 ml-3 border print:hidden"
                        @click="dialogHapusKinerja(item)"
                      >
                        <TrashIcon class="w-4 h-4 text-red-500" />
                      </button>
                    </div>
                  </td>
                  <td class="whitespace-pre-line">
                    {{ item.rencana_intervensi }}x
                  </td>
                  <td class="whitespace-pre-line">{{ item.rencana }}</td>
                  <td class="whitespace-pre-line">{{ item.aspek }}</td>
                  <td class="whitespace-pre-line">{{ item.indikator }}</td>
                  <td class="whitespace-pre-line">
                    {{ item.target }}
                  </td>
                </tr>
              </template>
              <tr v-else>
                <td colspan="6" class="text-center">BLEMUM ADA DATA</td>
              </tr>
              <tr
                class="font-semibold text-white bg-blue-400 whitespace-nowrap"
              >
                <td colspan="6" class="w-full whitespace-nowrap">
                  <div class="flex items-center justify-between">
                    B. TAMBAHAN
                    <button
                      v-if="!isPenilai"
                      class="flex px-2 py-1 ml-2 bg-green-500 print:hidden"
                      @click="openModalKinerja('TAMBAHAN')"
                    >
                      <PlusIcon class="w-4 h-4" /> TAMBAHAN
                    </button>
                  </div>
                </td>
              </tr>
              <template v-if="skp.tambahan_count > 0">
                <tr v-for="(item, index) in skp.tambahan" :key="item.id">
                  <td class="w-0 align-top whitespace-nowrap">
                    <div class="flex items-center whitespace-nowrap">
                      <p>{{ index + 1 }}</p>
                      <button
                        v-if="!isPenilai"
                        class="p-2 ml-3 border print:hidden"
                        @click="updateDataKinerja(item)"
                      >
                        <PencilIcon class="w-4 h-4 text-blue-400" />
                      </button>
                      <button
                        v-if="!isPenilai"
                        class="p-2 ml-3 border print:hidden"
                        @click="dialogHapusKinerja(item)"
                      >
                        <TrashIcon class="w-4 h-4 text-red-500" />
                      </button>
                    </div>
                  </td>
                  <td class="whitespace-pre-line">
                    {{ item.rencana_intervensi }}
                  </td>
                  <td class="whitespace-pre-line">{{ item.rencana }}</td>
                  <td class="whitespace-pre-line">{{ item.aspek }}</td>
                  <td class="whitespace-pre-line">{{ item.indikator }}</td>
                  <td class="whitespace-pre-line">
                    {{ item.target }}
                  </td>
                </tr>
              </template>
              <tr v-else>
                <td colspan="6" class="text-center">BLEMUM ADA DATA</td>
              </tr>
            </table>
          </div>
          <SkpPerilaku :skp="skp" :is-penilai="isPenilai" />
          <div class="w-full mt-4 overflow-x-auto">
            <table class="w-full">
              <tr>
                <td class="py-2 text-xs text-gray-100 bg-blue-400">RATING PERILAKU KERJA*</td>
              </tr>
              <tr>
                <td>
                  <select ref="rating" @change="changeRating" class="w-full text-xs">
                    <option value="">DI ATAS EKSPEKTASI / SESUAI EKSPEKTASI / DIBAWAH EKSPEKTASI**</option>
                    <option value="atas">DI ATAS EKSPEKTASI</option>
                    <option value="sesuai">SESUAI EKSPEKTASI</option>
                    <option value="bawah">DI BAWAH EKSPEKTASI</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="py-2 text-xs text-gray-100 bg-blue-400">RATING PERILAKU KERJA*</td>
              </tr>
              <tr>
                <td>
                  <select class="w-full text-xs" v-model="rating_status" disabled>
                    <option value="-">-</option>
                    <option value="baik">BAIK</option>
                    <option value="kurang">KURANG / MISCONDUCT</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div
            class="flex flex-col mt-5 mb-5 space-x-2 md:flex-row print:flex-row break-inside-avoid"
          >
            <div class="w-full text-center">
              Pegawai Yang Dinilai
              <br />
              <br />
              <br />
              <br />
              {{ skp.pegawai.nama_formatted }}
              <br />
              {{ skp?.pegawai.nip }}
            </div>
            <div class="flex w-full h-20 md:hidden"></div>
            <div class="w-full text-center">
              Pejabat Penilai Kinerja
              <br />
              <br />
              <br />
              <br />
              {{ skp.atasan?.nama_formatted }}
              <br />
              {{ skp.atasan?.nip }}
            </div>
          </div>
        </div>
      </div>
      <div>
        <FormModalUtama
          :show="formUtama"
          :active-jenis="jenisKinerja"
          :skp-id="skp.id"
          @close="formUtama = false"
        />
        <FormEditModalUtama
          :show="formEditKinerja"
          :active-jenis="kinerjaData.jenis"
          :kinerja="kinerjaData"
          @close="formEditKinerja = false"
        />
      </div>
      <DialogModal :show="modalDeleteKinerja" @close="modalDeleteKinerja">
        <template #title> Peringatan ! </template>
        <template #content> Akan menghapus data kinerja </template>

        <template #footer>
          <button class="mr-2 btn-main" @click="kirimHapusKinerja">
            Hapus
          </button>
          <button class="btn-danger" @click="closeModalHapusKinerja">
            Batal
          </button>
        </template>
      </DialogModal>
    </Backend>
  </div>
</template>

<style scoped></style>
