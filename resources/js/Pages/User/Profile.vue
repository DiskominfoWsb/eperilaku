<script setup>
/* eslint no-unused-vars: "off" */
/* eslint import/no-unresolved: "off" */
import { Link, Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import Backend from '@/Layouts/BackendLayout.vue'
import ProfilPegawai from './ProfilPegawai.vue'
import ProfilPengguna from './ProfilPengguna.vue'
import NoProfilSimpeg from '@/Pages/User/NoProfilSimpeg.vue'

const activeTab = ref(0)

// eslint-disable-next-line no-unused-vars
const props = defineProps({
  user: { type: Object, default: null },
  currentPhoto: { type: String, default: '' },
  golongan: { type: Object, default: null }
})

const photoPreview = ref(null)
const photoInput = ref(null)

const formUpdatePhoto = useForm({
  photo: String
})

const selectNewPhoto = () => {
  photoInput.value.click()
}

const updatePhotoPreview = () => {
  const photo = photoInput.value.files[0]

  if (!photo) return

  const reader = new FileReader()

  reader.onload = e => {
    photoPreview.value = e.target.result
  }

  reader.readAsDataURL(photo)
}

const updateProfileInformation = () => {
  if (photoInput.value) {
    updatePhotoPreview()
    formUpdatePhoto.photo = photoInput.value.files[0]
  }

  formUpdatePhoto.post(route('user-profile-photo.update'), {
    errorBag: 'updateProfilePhoto',
    preserveScroll: true,
    onError: () => {
      toastr.error(formUpdatePhoto.errors.photo, 'Peringatan!')
    },
    onSuccess: () => {
      toastr.success('Berhasi memperbaharui foto', 'success')
    }
  })
}
</script>

<template>
  <Backend>
    <div class="flex flex-col w-full md:flex-row md:space-x-2">
      <div class="flex-col justify-center w-full whitespace-no-wrap md:w-1/3">
        <div class="p-4 border rounded-lg shadow-md">
          <div class="flex justify-center w-full">
            <div v-show="!photoPreview" class="mt-2 cursor-pointer">
              <img
                :src="currentPhoto"
                :alt="user.pegawai?.nama"
                class="object-cover w-32 h-32 rounded-full"
                @click="selectNewPhoto()"
              />
            </div>
            <!-- New Profile Photo Preview -->
            <div
              v-show="photoPreview"
              class="mt-2 cursor-pointer"
              @click="selectNewPhoto()"
            >
              <span
                class="block w-32 h-32 bg-center bg-no-repeat bg-cover rounded-full"
                :style="'background-image: url(\'' + photoPreview + '\');'"
              />
            </div>
            <input
              ref="photoInput"
              type="file"
              class="hidden"
              accept=".jpg,.jpeg,.png"
              @change="updateProfileInformation()"
            />
          </div>

          <div class="w-full mt-2 text-sm text-center">
            <p>{{ user.pegawai?.nip }}</p>
            <div class="flex justify-center w-full">
              {{ user.pegawai?.nama_formatted }}
            </div>
            <div
              v-if="user.pegawai?.instansi != '-'"
              class="whitespace-no-wrap"
            >
              {{ user.pegawai?.instansi }}
            </div>
          </div>
        </div>
      </div>
      <div class="w-full mt-4 border rounded-md shadow-md md:mt-0">
        <div
          class="flex justify-between px-3 mt-2 space-x-3 text-sm md:space-x-6 md:px-6"
        >
          <button
            class="w-full px-3 py-2 text-center uppercase border-b-4"
            :class="activeTab === 0 ? 'border-blue-400' : 'border-gray-400'"
            @click="activeTab = 0"
          >
            Pegawai
          </button>
          <button
            class="w-full px-3 py-2 text-center uppercase border-b-4 hover:border-blue-500"
            :class="activeTab === 1 ? 'border-blue-400' : 'border-gray-400'"
            @click="activeTab = 1"
          >
            Pengaturan
          </button>
        </div>
        <div class="p-3 md:p-6">
          <ProfilPegawai
            v-if="activeTab === 0"
            :user="user.pegawai"
            :golongan="golongan"
          />
          <ProfilPengguna v-if="activeTab === 1" :user="user" />
        </div>
      </div>
    </div>
  </Backend>
</template>

<style scoped></style>
