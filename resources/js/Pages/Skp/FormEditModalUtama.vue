<script setup>
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Modal from '@/Components/Modal.vue'
import InputError from '@/Components/InputError.vue'

const emit = defineEmits(['close'])

const props = defineProps({
  kinerja: {
    type: Object,
    default: null
  },
  activeJenis: {
    type: String,
    default: null
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

const form = useForm({
  jenis: '',
  rencana_intervensi: '',
  skp_id: '',
  rencana: '',
  aspek: '',
  indikator: '',
  target: ''
})

const close = () => {
  emit('close')
}

const formReset = () => {
  form.reset()
  close()
}

const submit = () => {
  form.patch(route('kinerja.update', props.kinerja.id), {
    errorBag: 'updateKinerja',
    preserveScroll: true,
    onSuccess: () => formReset()
  })
}

watch(
  () => props.show,
  () => {
    form.jenis = props.kinerja.jenis
    form.rencana_intervensi = props.kinerja.rencana_intervensi
    form.rencana = props.kinerja.rencana
    form.aspek = props.kinerja.aspek
    form.indikator = props.kinerja.indikator
    form.target = props.kinerja.target
    // console.log(form)
  }
)
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="flex w-full justify-between bg-blue-400 px-4 py-2">
      <div class="w-full text-white font-semibold">
        TAMBAH RENCANA HASIL KERJA {{ kinerja.jenis }}
      </div>
      <button @click="formReset()">
        <XMarkIcon class="w-5 h-5 text-white" />
      </button>
    </div>
    <div class="px-4 py-2 text-sm">
      <form @submit.prevent="submit">
        <div class="w-full mt-4 md:mt-0 hidden">
          <TextInput v-model="form.jenis" />
        </div>
        <div class="mt-4">
          <label>Rencana Hasil Kerja Atasan yang di Intervensi</label>
          <textarea
            v-model="form.rencana_intervensi"
            maxlength="255"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <InputError class="mt-1" :message="form.errors.rencana_intervensi" />
        </div>
        <div class="mt-4">
          <label>Rencana Hasil Kerja</label>
          <textarea
            v-model="form.rencana"
            maxlength="255"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <InputError class="mt-1" :message="form.errors.rencana" />
        </div>
        <div class="mt-4">
          <label>Aspek </label>
          <textarea
            v-model="form.aspek"
            maxlength="255"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <InputError class="mt-1" :message="form.errors.aspek" />
        </div>
        <div class="mt-4">
          <label>Indikator </label>
          <textarea
            v-model="form.indikator"
            maxlength="255"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <InputError class="mt-1" :message="form.errors.indikator" />
        </div>
        <div class="mt-4">
          <label>Target</label>
          <textarea
            v-model="form.target"
            maxlength="255"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <InputError class="mt-1" :message="form.errors.target" />
        </div>
        <div class="mt-4 flex justify-center space-x-2 mb-4">
          <PrimaryButton type="button" @click="submit"> SIMPAN </PrimaryButton>
          <PrimaryButton type="button" @click="formReset">
            BATAL
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>

<style scoped></style>
