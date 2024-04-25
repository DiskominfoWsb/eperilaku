<script setup>
import Modal from '@/Components/Modal.vue'

const emit = defineEmits(['close'])

defineProps({
  pegawai: {
    type: Object,
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
  emit('close')
}
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="py-4 flex w-full justify-center">
      NIP : {{ pegawai.nip }} | Nama : {{ pegawai.nama_formatted }}
    </div>
    <div class="py-4 flex w-full justify-center">
      <img
        class="w-[512px]"
        :src="'/upload/profile/' + pegawai.user.photo"
        :alt="pegawai.nama"
      />
    </div>
    <div class="p-2 flex w-full justify-center">
      <button class="btn-danger" @click="close">TUTUP</button>
    </div>
  </Modal>
</template>

<style scoped></style>
