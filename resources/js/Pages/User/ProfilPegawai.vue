<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import toastr from 'toastr'
import { Head, useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  user: { type: Object, default: null },
  golongan: { type: Object, default: null }
})

const form = useForm({
  nip: props.user?.nip,
  nip_lama: props.user?.nip_lama,
  nama: props.user?.nama,
  gelar_depan: props.user?.gelar_depan,
  gelar_belakang: props.user?.gelar_belakang,
  t_lahir: props.user?.t_lahir,
  tgl_lahir: props.user?.tgl_lahir,
  jns_kelamin: props.user?.jns_kelamin ? props.user?.jns_kelamin : 'X',
  kode_gol: props.user?.golongan_id ? props.user?.golongan_id : 'X',
  no_telp: props.user?.no_telp,
  jabatan: props.user?.jabatan,
  instansi: props.user?.instansi
})

const formReset = () => {
  toastr.success(usePage().props.value.flash.message)
}

const submit = () => {
  form.post(route('update.data.pegawai'), {
    errorBag: 'updatePegawaiInformation',
    preserveScroll: true,
    onSuccess: () => formReset()
  })
}
</script>
<template>
  <Head title="Profil Pegawai" />
  <div class="text-xs">
    <form @submit.prevent="submit">
      <div class="flex flex-col md:flex-row w-full space-x-0 md:space-x-2">
        <div class="w-full">
          <label>NIP</label>
          <TextInput v-model="form.nip" type="text" :errors="form.errors.nip" />
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
      <div class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2">
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
      <div class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2">
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
      <div class="flex flex-col md:flex-row w-full mt-4 space-x-0 md:space-x-2">
        <div class="w-full mt-4 md:mt-0">
          <label>Golongan</label>
          <select
            v-model="form.kode_gol"
            class="appearance-none w-full text-sm mt-1 border border-slate-300 py-2 px-3 rounded-md focus:ring-0"
          >
            <option value="X">-- Pilih --</option>
            <option v-for="gol in golongan" :key="gol.id" :value="gol.id">
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
      <div class="flex w-full justify-between mt-5">
        <PrimaryButton
          type="button"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="submit"
        >
          SIMPAN
        </PrimaryButton>
        <PrimaryButton type="button"> Ambil data simpeg </PrimaryButton>
      </div>
    </form>
  </div>
</template>
