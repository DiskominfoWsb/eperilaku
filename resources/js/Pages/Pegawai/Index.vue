<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Link, useForm, Head } from '@inertiajs/vue3';
import {
  EyeIcon,
  PencilIcon,
  TrashIcon,
  XCircleIcon
} from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import Backend from '@/Layouts/BackendLayout.vue'
import Permission from '@/Components/Permission.vue'
import DialogModal from '@/Components/DialogModal.vue'
import DangerButton from '@/Components/DangerButton.vue'
import ImagesModal from '@/Components/ImagesModal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AvatarSquare from '@/Components/AvatarSquare.vue'

const confirmingUserDeletion = ref(false)
const showUserImages = ref(false)
const pegawaiData = ref(null)

defineProps({
  master: { type: Object, default: null }
})

const form = useForm({
  passsword: ''
})

const confirmUserDeletion = pegawai => {
  confirmingUserDeletion.value = true
  pegawaiData.value = pegawai
}

const closeModal = () => {
  confirmingUserDeletion.value = false
  showUserImages.value = false
  form.reset()
}

const deleteUser = () => {
  form.delete(route('pegawai.destroy', pegawaiData.value), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => form.reset()
  })
}

const modalUserImages = pegawai => {
  pegawaiData.value = pegawai
  showUserImages.value = true
}
</script>

<template>
  <Head title="Daftar Data Pegawai" />
  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">Data Pegawai</div>
        <div class="text-xs text-gray-500">Halaman Data Pegawai.</div>
        <div class="mt-3 mb-4 border-b" />
        <div class="flex justify-end">
          <Permission can="create_users">
            <Link
              :href="route('pegawai.create')"
              class="inline-block px-4 py-2.5 bg-blue-400 text-white font-semibold text-sm leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-300 active:shadow-lg transition duration-150 ease-in-out"
            >
              TAMBAH
            </Link>
          </Permission>
        </div>
        <div class="flex items-center justify-end w-full">
          <div class="w-full overflow-x-auto">
            <table class="w-full mt-4 text-sm">
              <tr>
                <td
                  class="hidden w-0 text-center whitespace-nowrap md:table-cell"
                  rowspan="2"
                >
                  No
                </td>
                <td class="w-24 text-center" rowspan="2">Foto</td>
                <td class="table-cell md:hidden">Data Pegawai</td>
                <td
                  class="hidden w-0 text-center whitespace-nowrap md:table-cell"
                >
                  Nip
                </td>
                <td class="hidden w-auto md:table-cell">Nama</td>
                <td class="hidden text-center md:table-cell">Instansi</td>
                <td rowspan="2" class="hidden text-center md:table-cell">
                  Action
                </td>
              </tr>
              <tr>
                <td class="table-cell w-0 whitespace-nowrap md:hidden">-</td>
                <td class="hidden md:table-cell">-</td>
                <td class="hidden md:table-cell">-</td>
                <td class="hidden md:table-cell">-</td>
              </tr>
              <template v-if="master.data.length > 0">
                <tr v-for="(pegawai, index) in master.data" :key="pegawai.id">
                  <td class="hidden md:table-cell">
                    {{ index + master.from }}
                  </td>
                  <td class="justify-center text-center">
                    <div class="flex justify-center w-full">
                      <AvatarSquare
                        :alt="pegawai.nama"
                        :images="pegawai.user.photo"
                        @click="modalUserImages(pegawai)"
                      />
                    </div>
                  </td>
                  <td class="table-cell whitespace-pre-line md:hidden">
                    {{ pegawai.nip }}<br />
                    {{ pegawai?.nama_formatted }}<br />
                    {{ pegawai.instansi }}<br />
                  </td>
                  <td class="hidden md:table-cell">{{ pegawai.nip }}</td>
                  <td class="hidden md:table-cell">
                    {{ pegawai?.nama_formatted }}
                  </td>
                  <td class="hidden w-0 whitespace-nowrap md:table-cell">
                    {{ pegawai.instansi }}
                  </td>
                  <td class="hidden w-0 whitespace-nowrap md:table-cell">
                    <div
                      v-if="pegawai.user.level?.name !== 'super-admin'"
                      class="flex justify-center w-full space-x-2"
                    >
                      <Link :href="route('pegawai.show', pegawai.id)">
                        <EyeIcon class="w-5 h-5 hover:text-blue-400" />
                      </Link>
                      <Link
                        :href="route('pegawai.edit', pegawai)"
                        methods="get"
                      >
                        <PencilIcon class="w-5 h-5 hover:text-yellow-500" />
                      </Link>
                      <button @click="confirmUserDeletion(pegawai)">
                        <TrashIcon class="w-5 h-5 text-red-500" />
                      </button>
                    </div>
                    <div v-else class="flex justify-center w-full">
                      <XCircleIcon
                        class="w-5 h-5 text-red-500 cursor-pointer"
                        title="Disable for Super Admin"
                      />
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
      </div>
    </div>
    <ImagesModal
      :show="showUserImages"
      :pegawai="pegawaiData"
      @close="showUserImages = false"
    />
    <DialogModal :show="confirmingUserDeletion" @close="closeModal = true">
      <template #title> Hapus Data Pegawai </template>

      <template #content>
        <p>Apakah Anda yakin ingin menghapus data pegawai?</p>
      </template>

      <template #footer>
        <DangerButton @click="closeModal"> BATAL </DangerButton>

        <PrimaryButton
          class="ml-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="deleteUser"
        >
          HAPUS
        </PrimaryButton>
      </template>
    </DialogModal>
  </Backend>
</template>

<style scoped></style>
