<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Backend from '@/Layouts/BackendLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'

const logoInput = ref(null)
const logoPreview = ref(null)
const backgroundInput = ref(null)
const backgroundPreview = ref(null)

const props = defineProps({
  setting: { type: Object, default: null }
})

const form = useForm({
  name: props.setting.name,
  description: props.setting.description,
  alamat: props.setting.alamat,
  phone: props.setting.phone,
  logo: null,
  frontend_background: null
})

const submit = () => {
  if (logoInput.value) {
    form.logo = logoInput.value.files[0]
  }
  if (backgroundInput.value) {
    form.frontend_background = backgroundInput.value.files[0]
  }
  form.post(route('settings.store'), {
    errorBag: 'updateSetting',
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      toastr.success('Berhasil memperbarui Pengaturan Aplikasi', 'success')
    },
    onFinish: () => {},
    onError: err => {
      err.forEach(toastr.error(Object.values(err)[0], 'error'))
    }
  })
}

const selectNewLogo = () => {
  logoInput.value.click()
}

const selectNewBackground = () => {
  backgroundInput.value.click()
}

const updateLogoPreview = () => {
  const logo = logoInput.value.files[0]

  if (!logo) return

  const reader = new FileReader()

  reader.onload = e => {
    logoPreview.value = e.target.result
  }

  reader.readAsDataURL(logo)
  submit()
}

const updateBackgroundPreview = () => {
  const background = backgroundInput.value.files[0]

  if (!background) return

  const reader = new FileReader()

  reader.onload = e => {
    backgroundPreview.value = e.target.result
  }

  reader.readAsDataURL(background)
  submit()
}
</script>

<template>
  <Head title="Pengaturan Applikasi" />

  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">Pengaturan Applikasi</div>
        <div class="text-xs text-gray-500">Halaman Pengaturan Applikasi.</div>
        <div class="mt-3 mb-4 border-b" />
        <div>
          <form @submit.prevent="submit">
            <table class="w-full text-sm md:w-1/3">
              <tr>
                <td class="w-0 whitespace-nowrap">Nama Aplikasi</td>
                <td>
                  <div class="flex items-center">
                    <InputLabel for="name" value=":" class="mr-2" />
                    <TextInput
                      id="name"
                      v-model="form.name"
                      class="block w-full px-2 py-1 mt-1 border rounded-sm appearance-none focus:outline-none focus:ring-0"
                      required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td>
                  <div class="flex items-center">
                    <InputLabel for="description" value=":" class="mr-2" />
                    <div class="flex flex-col w-full">
                      <TextInput
                        id="description"
                        v-model="form.description"
                        :errors="form.errors.description"
                        class="block w-full px-2 py-1 mt-1 border rounded-sm appearance-none focus:outline-none focus:ring-0"
                        required
                      />
                      <InputError
                        class="mt-1"
                        :message="form.errors.description"
                      />
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>
                  <div class="flex items-center">
                    <InputLabel for="alamat" value=":" class="mr-2" />
                    <TextInput
                      id="alamat"
                      v-model="form.alamat"
                      class="block w-full px-2 py-1 mt-1 border rounded-sm appearance-none focus:outline-none focus:ring-0"
                      required
                    />
                    <InputError class="mt-2" :message="form.errors.alamat" />
                  </div>
                </td>
              </tr>

              <tr>
                <td>No. Telpon</td>
                <td>
                  <div class="flex items-center">
                    <InputLabel for="phone" value=":" class="mr-2" />
                    <TextInput
                      id="phone"
                      v-model="form.phone"
                      class="block w-full px-2 py-1 mt-1 border rounded-sm appearance-none focus:outline-none focus:ring-0"
                      required
                    />
                    <InputError class="mt-2" :message="form.errors.phone" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="align-top">Logo</td>
                <td>
                  <div v-show="!logoPreview" class="mt-2">
                    <img
                      class="w-32 cursor-pointer"
                      :src="setting.logo"
                      :alt="setting.name"
                      @click="selectNewLogo"
                    />
                  </div>

                  <!-- New Profile Photo Preview -->
                  <div
                    v-show="logoPreview"
                    class="w-32 h-40 mt-2 cursor-pointer"
                    @click="selectNewLogo"
                  >
                    <span
                      class="block w-32 h-40 pb-4 bg-no-repeat bg-cover"
                      :style="'background-image: url(\'' + logoPreview + '\');'"
                    />
                  </div>
                  <input
                    ref="logoInput"
                    type="file"
                    class="hidden"
                    accept="image/png"
                    @change="updateLogoPreview"
                  />
                </td>
              </tr>
              <tr>
                <td class="align-top">Background</td>
                <td class="whitespace-nowrap">
                  <div v-show="!backgroundPreview" class="mt-2">
                    <img
                      class="w-48 h-32 cursor-pointer"
                      :src="setting.frontend_background"
                      :alt="setting.name"
                      @click="selectNewBackground"
                    />
                  </div>
                  <div
                    v-show="backgroundPreview"
                    class="w-48 h-32 mt-2 cursor-pointer"
                    @click="selectNewBackground"
                  >
                    <span
                      class="block w-48 h-32 bg-no-repeat bg-contain"
                      :style="
                        'background-image: url(\'' + backgroundPreview + '\');'
                      "
                    />
                  </div>
                  <input
                    ref="backgroundInput"
                    type="file"
                    class="hidden"
                    accept=".jpg,.jpeg,.png,.gif"
                    @change="updateBackgroundPreview"
                  />
                </td>
              </tr>
              <tr>
                <td class="align-top" />
                <td class="whitespace-nowrap">
                  <button class="btn-main" @click="submit">SIMPAN</button>
                  <Link
                    class="ml-3 btn-warning"
                    :href="route('settings')"
                    methods="get"
                  >
                    RESET
                  </Link>
                </td>
              </tr>
            </table>
          </form>
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
