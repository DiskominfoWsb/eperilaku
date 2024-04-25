<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Link, useForm, Head } from '@inertiajs/vue3';
import { ref } from 'vue'
import { EyeIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import Backend from '@/Layouts/BackendLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import ConfirmationModal from '@/Components/ConfirmationModal.vue'
import FormModalNewSkp from '@/Pages/Skp/FormModalNewSkp.vue'
import UpdateSkpForm from '@/Pages/Skp/UpdateSkpForm.vue'

defineProps({
  user: { type: Object, default: null },
  master: { type: Object, default: null },
  masterDinilai: { type: Object, default: null },
  countPegawai: { type: Number, default: 0 },
  isActive: { type: Number, default: 0 }
})
const ModalNewSkp = ref(false)
const ModalUpdateSkp = ref(false)
const SkpData = ref({})
const confirmingUserDeletion = ref(false)

const OpenModalUpdateSkp = (open, skp) => {
  ModalUpdateSkp.value = open
  SkpData.value = skp
}

const form = useForm({
  skp: ''
})

const confirmUserDeletion = skp => {
  confirmingUserDeletion.value = true
  form.skp = skp
}

const deleteSkp = () => {
  form.delete(route('skp.destroy', form.skp), {
    preserveScroll: true,
    preserveState: true,
    onFinish: () => {
      confirmingUserDeletion.value = false
    },
    onSuccess: () => {
      toastr.success('Berhasil menghapus skp', 'success')
    },
    onError: () => {
      toastr.error('Gagal menghapus skp', 'warning')
    }
  })
}
</script>

<template>
  <Head title="Daftar Data Skp" />
  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">SKP</div>
        <div class="text-xs text-gray-500">Halaman dafttar SKP.</div>
        <div class="mt-3 mb-4 border-b" />
        <div class="flex items-center justify-end w-full">
          <Link
            v-if="countPegawai < 1"
            :href="route('me')"
            class="px-3 py-2 text-xs text-white bg-blue-400"
          >
            LENGKAPI DATA PEGAWAI
          </Link>
          <PrimaryButton
            v-else
            class="px-3 py-2 text-xs text-white bg-blue-400"
            @click="ModalNewSkp = true"
          >
            TAMBAH
          </PrimaryButton>
        </div>
        <div
          class="flex flex-col mt-4 space-x-0 text-sm md:flex-row md:space-x-2"
        >
          <div class="w-full md:w-1/2">
            <div
              class="w-full bg-blue-400 py-1.5 text-xs font-semibold text-white px-3"
            >
              SKP ANDA
            </div>
            <div class="overflow-x-auto">
              <table class="table w-full text-xs">
                <tr>
                  <td>No</td>
                  <td>Mulai</td>
                  <td>Sampai</td>
                  <td>Status</td>
                  <td class="text-center">Aksi</td>
                </tr>
                <template v-if="master.data.length > 0">
                  <tr v-for="(skp, index) in master.data" :key="skp.id">
                    <td>{{ index + 1 }}</td>
                    <td class="whitespace-nowrap">
                      {{ skp.skp_mulai }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ skp.skp_selesai }}
                    </td>
                    <td class="items-center">
                      {{ skp.status }}
                    </td>
                    <td class="w-0">
                      <div class="flex justify-center w-full space-x-2">
                        <Link :href="route('skp.show', skp.id)" as="button">
                          <EyeIcon class="w-5 h-5" />
                        </Link>
                        <button @click="OpenModalUpdateSkp(true, skp)">
                          <PencilIcon class="w-5 h-5" />
                        </button>
                        <button @click="confirmUserDeletion(skp.id)">
                          <TrashIcon class="w-5 h-5" />
                        </button>
                      </div>
                    </td>
                  </tr>
                </template>
                <tr v-else>
                  <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="w-full mt-4 md:w-1/2 md:mt-0">
            <div
              class="w-full bg-blue-400 py-1.5 text-xs font-semibold text-white px-3"
            >
              SKP YANG ANDA NILAI
            </div>
            <div class="overflow-x-auto">
              <table class="table w-full text-xs">
                <tr>
                  <td>No</td>
                  <td>Mulai</td>
                  <td>Sampai</td>
                  <td>Prmohon</td>
                  <td>Status</td>
                  <td class="text-center">Aksi</td>
                </tr>
                <template v-if="masterDinilai.data?.length > 0">
                  <tr v-for="(skp, index) in masterDinilai.data" :key="skp.id">
                    <td>{{ index + 1 }}</td>
                    <td class="whitespace-nowrap">
                      {{ skp.skp_mulai }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ skp.skp_selesai }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ skp.pegawai.nama_formatted }}
                    </td>
                    <td class="items-center">
                      {{ skp.status }}
                    </td>
                    <td class="w-0">
                      <div class="flex justify-center w-full space-x-2">
                        <Link :href="route('skp.show', skp.id)" as="button">
                          <EyeIcon class="w-5 h-5" />
                        </Link>
                      </div>
                    </td>
                  </tr>
                </template>
                <tr v-else>
                  <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Backend>
  <ConfirmationModal
    :show="confirmingUserDeletion"
    @close="confirmingUserDeletion = false"
  >
    <template #content> Hapus Data Skp </template>
    <template #footer>
      <PrimaryButton @click="deleteSkp()"> HAPUS </PrimaryButton>
      <DangerButton class="ml-3" @click="confirmingUserDeletion = false">
        BATAL
      </DangerButton>
    </template>
  </ConfirmationModal>
  <UpdateSkpForm
    v-if="ModalUpdateSkp"
    :skp="SkpData"
    @update-skp-form-open="ModalUpdateSkp = false"
  />
  <FormModalNewSkp :show="ModalNewSkp" @close="ModalNewSkp = false" />
</template>

<style scoped></style>
