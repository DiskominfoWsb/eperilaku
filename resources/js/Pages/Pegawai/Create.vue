<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import toastr from 'toastr'
import Backend from '@/Layouts/BackendLayout.vue'
import Permission from '@/Components/Permission.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
  golongan: { type: Object, default: null }
})

const form = useForm({
  nip: '',
  nip_lama: '',
  nama: '',
  gelar_depan: '',
  gelar_belakang: '',
  t_lahir: '',
  tgl_lahir: '',
  jns_kelamin: 'X',
  kode_gol: 'X',
  no_telp: '',
  jabatan: '',
  instansi: '',
  email: '',
  name: '',
  username: '',
  password: '',
  password_confirmation: ''
})

const formReset = () => {
  toastr.success(usePage().props.value.flash.message)
  form.reset()
}

const submit = () => {
  form.post(route('pegawai.store'), {
    errorBag: 'createNewPegawai',
    preserveScroll: true,
    onSuccess: () => formReset()
  })
}
</script>

<template>
  <Backend>
    <div class="w-full border border-gray-200 rounded shadow p-5">
      <div class="w-full bg-white rounded">
        <div class="font-bold text-sm text-gray-500">Tambah Data Pegawai</div>
        <div class="text-xs text-gray-500">Halaman Tambah Data Pegawai.</div>
        <div class="mt-3 border-b mb-4" />
        <div class="justify-end hidden">
          <Permission can="create_users">
            <PrimaryButton> TEMPLATE IMPORT PEGAWAI </PrimaryButton>
            <PrimaryButton class="ml-2"> IMPORT PEGAWAI </PrimaryButton>
          </Permission>
        </div>
        <div class="w-full text-sm mt-5 select-none">
          <form @submit.prevent="submit">
            <div
              class="w-full bg-blue-400 uppercase text-white font-semibold py-1.5 px-3"
            >
              Informasi Data Pegawai
            </div>
            <div class="mt-4">
              <div
                class="flex flex-col md:flex-row w-full space-x-0 md:space-x-2"
              >
                <div class="w-full">
                  <label>NIP</label>
                  <TextInput
                    v-model="form.nip"
                    type="text"
                    :errors="form.errors.nip"
                  />
                  <InputError :message="form.errors.nip" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>Nama</label>
                  <TextInput
                    v-model="form.nama"
                    type="text"
                    :errors="form.errors.nama"
                  />
                  <InputError :message="form.errors.nama" />
                </div>
              </div>
              <div
                class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2"
              >
                <div class="w-full md:mt-0">
                  <label>Gelar Depan</label>
                  <TextInput
                    v-model="form.gelar_depan"
                    type="text"
                    :errors="form.errors.gelar_depan"
                  />
                  <InputError :message="form.errors.gelar_depan" />
                </div>

                <div class="w-full mt-4 md:mt-0">
                  <label>Gelar Belakang</label>
                  <TextInput
                    v-model="form.gelar_belakang"
                    type="text"
                    :errors="form.errors.gelar_belakang"
                  />
                  <InputError :message="form.errors.gelar_belakang" />
                </div>
              </div>
              <div
                class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2"
              >
                <div class="w-full">
                  <label>Tempat Lahir</label>
                  <TextInput
                    v-model="form.t_lahir"
                    type="text"
                    :errors="form.errors.t_lahir"
                  />
                  <InputError :message="form.errors.t_lahir" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>Tanggal Lahir</label>
                  <TextInput
                    v-model="form.tgl_lahir"
                    type="date"
                    :errors="form.errors.tgl_lahir"
                  />
                  <InputError :message="form.errors.tgl_lahir" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>Jenis Kelamin</label>
                  <select
                    v-model="form.jns_kelamin"
                    class="block appearance-none w-full text-sm mt-1 border border-slate-300 py-2 px-3 rounded-md"
                  >
                    <option value="X">-- Pilih --</option>
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                  <InputError :message="form.errors.jns_kelamin" />
                </div>
              </div>
              <div
                class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2"
              >
                <div class="w-full mt-4 md:mt-0">
                  <label>Golongan</label>
                  <select
                    v-model="form.kode_gol"
                    class="appearance-none w-full text-sm mt-1 border border-slate-300 py-2 px-3 rounded-md focus:ring-0"
                  >
                    <option value="X">-- Pilih --</option>
                    <option
                      v-for="gol in golongan"
                      :key="gol.id"
                      :value="gol.id"
                    >
                      {{ gol.golongan }}/{{ gol.ruang }} {{ gol.pangkat }}
                    </option>
                  </select>
                  <InputError :message="form.errors.kode_gol" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>Jabatan</label>
                  <TextInput
                    v-model="form.jabatan"
                    type="text"
                    :errors="form.errors.jabatan"
                  />
                  <InputError :message="form.errors.jabatan" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>Unit Kerja</label>
                  <TextInput
                    v-model="form.instansi"
                    type="text"
                    :errors="form.errors.instansi"
                  />
                  <InputError :message="form.errors.instansi" />
                </div>
                <div class="w-full mt-4 md:mt-0">
                  <label>No Telpon / Wa</label>
                  <TextInput
                    v-model="form.no_telp"
                    type="text"
                    placeholder="08XXXXXXXXX"
                    :errors="form.errors.no_telp"
                  />
                  <InputError :message="form.errors.no_telp" />
                </div>
              </div>
            </div>
            <div
              class="w-full bg-blue-400 uppercase text-white font-semibold py-1.5 px-3 mt-4"
            >
              Informasi Data Akun
            </div>
            <div class="mt-4">
              <div class="w-full">
                <label>E-Mail</label>
                <TextInput
                  v-model="form.email"
                  type="text"
                  :errors="form.errors.email"
                />
                <InputError :message="form.errors.email" />
              </div>
              <div class="w-full mt-4">
                <label>Password</label>
                <TextInput
                  v-model="form.password"
                  type="text"
                  :errors="form.errors.password"
                />
                <InputError :message="form.errors.password" />
              </div>
              <div class="w-full mt-4">
                <label>Konfirmasi Password</label>
                <TextInput
                  v-model="form.password_confirmation"
                  type="text"
                  :errors="form.errors.password_confirmation"
                />
                <InputError :message="form.errors.password_confirmation" />
              </div>
            </div>
            <div class="mt-5">
              <PrimaryButton
                type="button"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="submit"
              >
                SIMPAN
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Backend>
</template>

<style scoped></style>
