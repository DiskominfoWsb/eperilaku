<script setup>
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { useForm } from '@inertiajs/vue3';
import moment from 'moment'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'
import Modal from '@/Components/Modal.vue'

const emit = defineEmits(['close'])

defineProps({
  skpId: {
    type: String,
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

const close = () => {
  emit('close', false)
}

const form = useForm({
  mulai: moment().startOf('year').format('YYYY-MM-DD'),
  tahun: new Date().getFullYear(),
  selesai: moment().endOf('year').format('YYYY-MM-DD'),
  pendekatan: 'KUANTITATIF'
})

const submit = () => {
  form.post(route('skp.store'), {
    onSuccess: () => close()
  })
}
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close()"
  >
    <div class="flex w-full justify-between bg-blue-400 px-4 py-2">
      <div class="w-full text-white font-semibold">TAMBAH SKP BARU</div>
      <button @click="close()">
        <XMarkIcon class="w-5 h-5 text-white" />
      </button>
    </div>
    <div class="px-4 py-2 text-xs">
      <form @submit.prevent="submit">
        <div class="mt-4">
          <label>Tanggal Mulai</label>
          <TextInput v-model="form.mulai" type="date" />
        </div>
        <div class="mt-4">
          <label>Tanggal Selesai</label>
          <TextInput v-model="form.selesai" type="date" />
        </div>
        <div class="mt-4">
          <label>Pendekatan</label>
          <TextInput v-model="form.pendekatan" type="text" disabled="true" />
        </div>
        <div class="mt-4 flex justify-center space-x-2 mb-4">
          <PrimaryButton
            type="button"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="submit"
          >
            SIMPAN
          </PrimaryButton>
          <DangerButton type="button" @click="close()"> BATAL </DangerButton>
        </div>
      </form>
    </div>
  </Modal>
</template>

<style scoped></style>
