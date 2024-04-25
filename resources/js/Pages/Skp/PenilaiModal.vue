<script setup>
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import axios from 'axios'
import Modal from '@/Components/Modal.vue'

const emit = defineEmits(['close', 'atasan'])

defineProps({
  skpId: {
    type: String,
    default: ''
  },
  show: {
    type: Boolean,
    default: false
  },
  maxWidth: {
    type: String,
    default: '2xl'
  },
  closeable: {
    type: Boolean,
    default: true
  }
})

const input = ref(null)

const nip = ref('')

const dataAtasan = ref({})

const getPegawai = () => {
  axios
    .post(route('get.pegawai'), { nip: nip.value })
    .then(resp => {
      dataAtasan.value = resp.data
      if (dataAtasan.value.length > 0) {
        toastr.success('Berhasil mencari data atasan', 'Success')
      } else {
        toastr.error('Data atasan tidak ditemukan', 'Peringatan!')
      }
    })
    .catch(errs => {
      toastr.error(`Gagal${errs.message}`, 'Peringatan!')
    })
}

const closeAtasan = () => {
  emit('atasan', nip.value)
}

const close = () => {
  emit('close')
}

const updateAtasan = (skp, atasan) => {
  axios
    .post(route('skp.update.atasan'), { atasan, skp })
    .then(resp => {
      if (resp.data.status) {
        toastr.success('Berhasil pilih atasan', 'success')
        closeAtasan()
        close()
      } else {
        toastr.error(resp.data.message, 'Peringatan!')
      }
    })
    .catch(errs => {
      toastr.error(errs.message, 'Peringatan!')
    })
}
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="flex justify-between w-full px-4 py-2 bg-blue-400">
      <div class="w-full font-semibold text-white">PEJABAT PENILAI KINERJA</div>
      <button @click="close">
        <XMarkIcon class="w-5 h-5 text-white" />
      </button>
    </div>
    <div class="px-4 py-2 text-xs">
      <form>
        <label
          for="search"
          class="mb-2 text-xs text-gray-900 dark:text-gray-300"
          >NIP PEJABAT PENILAI :</label
        >
        <div class="relative">
          <input
            id="search"
            ref="input"
            v-model="nip"
            type="text"
            placeholder="NIP"
            required
            autofocus
            class="w-full text-xs border border-gray-300"
          />
          <button
            type="button"
            class="text-white absolute right-0 bottom-0 top-0 bg-blue-700 hover:bg-blue-800 focus:ring-0 focus:outline-none focus:ring-blue-300 text-sm px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            @click="getPegawai()"
          >
            Cari
          </button>
        </div>
        <div class="mt-4">
          <table class="w-full">
            <tr>
              <td class="w-0">NIP</td>
              <td>NAMA</td>
              <td class="w-0 whitespace-nowrap">UNIT KERJA</td>
            </tr>
            <tr
              v-for="atasan in dataAtasan"
              :key="atasan.id"
              class="hover:bg-blue-400 hover:cursor-pointer"
              @click="updateAtasan(skpId, atasan.id)"
            >
              <td class="whitespace-nowrap">
                {{ atasan.nip }}
              </td>
              <td class="whitespace-nowrap">
                {{ atasan?.nama_formatted }}
              </td>
              <td class="whitespace-nowrap">
                {{ atasan.instansi }}
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </Modal>
</template>

<style scoped></style>
