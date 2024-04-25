<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import toastr from 'toastr'
import Backend from '@/Layouts/BackendLayout.vue'
import Permission from '@/Components/Permission.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'
import { onMounted } from 'vue'

const props =  defineProps({
  pegawai: { type: Object, default: null },
  golongan: { type: Object, default: null }
})

const form = useForm({
  nip: props.pegawai.nip,
  nip_lama: props.pegawai.nip_lama,
  nama: props.pegawai.nama,
  gelar_depan: props.pegawai.gelar_depan,
  gelar_belakang: props.pegawai.gelar_belakang,
  t_lahir: props.pegawai.t_lahir,
  tgl_lahir: props.pegawai.tgl_lahir,
  jns_kelamin: props.pegawai.jns_kelamin,
  kode_gol: props.pegawai.golongan_id,
  no_telp: props.pegawai.no_telp,
  jabatan: props.pegawai.jabatan,
  instansi: props.pegawai.instansi,
  email: props.pegawai.user.email,
  username: '',
  password: '',
  password_confirmation: ''
})

const formReset = () => {
  toastr.success(usePage().props.value.flash.message)
}

const submit = () => {
  form.patch(route('pegawai.update', props.pegawai.id), {
    errorBag: 'updatePegawaiInformation',
    preserveScroll: true,
    onSuccess: () => formReset()
  })
}

const bindData = () => {
    form = props.pegawai
    console.log(form.nip)
}
</script>

<template>
  <Backend>
    <div class="w-full p-5 border border-gray-200 rounded shadow">
      <div class="w-full bg-white rounded">
        <div class="text-sm font-bold text-gray-500">Tambah Data Pegawai</div>
        <div class="text-xs text-gray-500">Halaman Tambah Data Pegawai.</div>
        <div class="mt-3 mb-4 border-b" />
        <div class="justify-end hidden">
          <Permission can="create_users">
            <PrimaryButton> TEMPLATE IMPORT PEGAWAI </PrimaryButton>
            <PrimaryButton class="ml-2"> IMPORT PEGAWAI </PrimaryButton>
          </Permission>
        </div>
        {{ pegawai }}
        <div class="w-full mt-5 text-sm select-none">
          <form @submit.prevent="submit">
            <div
              class="w-full bg-blue-400 uppercase text-white font-semibold py-1.5 px-3"
            >
              Informasi Data Pegawai
            </div>
            <div class="mt-4">
              <div
                class="flex flex-col w-full space-x-0 md:flex-row md:space-x-2"
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
                class="flex flex-col w-full mt-4 space-x-0 md:flex-row md:space-x-2"
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
                class="flex flex-col w-full mt-4 space-x-0 md:flex-row md:space-x-2"
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
                    class="block w-full px-3 py-2 mt-1 text-sm border rounded-md appearance-none border-slate-300"
                  >
                    <option value="X">-- Pilih --</option>
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                  <InputError :message="form.errors.jns_kelamin" />
                </div>
              </div>
              <div
                class="flex flex-col w-full mt-4 space-x-0 md:flex-row md:space-x-2"
              >
                <div class="w-full mt-4 md:mt-0">
                  <label>Golongan</label>
                  <select
                    v-model="form.kode_gol"
                    class="w-full px-3 py-2 mt-1 text-sm border rounded-md appearance-none border-slate-300 focus:ring-0"
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
